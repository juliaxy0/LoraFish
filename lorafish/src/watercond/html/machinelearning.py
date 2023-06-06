import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sqlalchemy import create_engine
import json

# Establish a connection to the MySQL database using SQLAlchemy
engine = create_engine('mysql+pymysql://root:@localhost/lorafishdb')

# Fetch the latest readings from the MySQL database
query = "SELECT * FROM watercondition ORDER BY date DESC LIMIT 5"
latest_data = pd.read_sql(query, con=engine)

# Define features and target variable
X = latest_data[['acidity', 'oxygen', 'hydrogen', 'nitrate', 'carbonDioxide', 'mercury', 'hydrogenSulfide', 'temperature']]
y = latest_data['tankNo']

# Train a Random Forest classifier
classifier = RandomForestClassifier()
classifier.fit(X, y)

# Fetch all tank data from the MySQL database
all_data_query = "SELECT * FROM watercondition"
all_data = pd.read_sql(all_data_query, con=engine)

# Remove the 'date' and 'tankNo' columns from the all_data DataFrame
all_data = all_data.drop(columns=['date', 'tankNo'])

# Make predictions for all tank data
predicted_tanks = classifier.predict(all_data)

# Create a DataFrame with tank predictions
tank_predictions = pd.DataFrame({'tankNo': all_data.index, 'predicted_tank': predicted_tanks})

# Count the number of times each tank appears in the predictions
tank_counts = tank_predictions['predicted_tank'].value_counts()

# Calculate the total number of tanks
total_tanks = len(tank_predictions)

# Calculate the percentage of exceedances for each tank
predictions = []
for tank, count in tank_counts.items():
    percentage = round((count / total_tanks) * 100, 2)
    predictions.append({'tankNo': tank, 'percentage_exceedances': percentage})

# Convert the predictions to a JSON string
json_predictions = json.dumps(predictions)

# Print the JSON string
print(json_predictions)
