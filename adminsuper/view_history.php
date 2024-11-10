<?php
// Include your database connection
include("../connection.php");

// Check if the id is set in the GET parameters
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure id is an integer

    // Query to fetch specific patient's history details
    $sql = "
        SELECT 
            patient_name, 
            age, 
            sex, 
            cs, 
            address, 
            contract_number, 
            religion, 
            date_time, 
            accompanied_by, 
            chief_complaints,
            history_present_illness, 
            past_medical_history, 
            hypertension, 
            hypertension_meds, 
            diabetes, 
            diabetes_meds, 
            asthma, 
            asthma_meds, 
            others, 
            others_meds, 
            occupation, 
            smoking, 
            pack_years, 
            alcohol, 
            alcohol_frequency, 
            others_social, 
            others_social_detail, 
            pediatric_feeding, 
            pediatric_feeding_others, 
            allergies_food, 
            allergies_drugs, 
            allergies_others, 
            lmp, 
            g, 
            p, 
            ob_others, 
            previous_surgeries, 
            bcg, 
            dpt_polio, 
            hepatitis_b, 
            measles, 
            immunization_others, 
            altered_mental_sensorium, 
            pain, 
            history_category
        FROM 
            history_sheet
        WHERE 
            id = ?
    ";

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #4CAF50;
                color: white;
                font-weight: bold;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            td {
                color: #555;
            }
            @media (max-width: 600px) {
                table {
                    font-size: 14px;
                }
            }
            .print-btn {
                display: block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-align: center;
                font-size: 16px;
            }
            .print-btn:hover {
                background-color: #45a049;
            }
        </style>
        <h1>Patient History Details</h1>
        <button class="print-btn" onclick="window.print();">Print</button>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
            </tr>
            <tr>
                <td><strong>Age</strong></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
            </tr>
            <tr>
                <td><strong>Sex</strong></td>
                <td><?php echo htmlspecialchars($row['sex']); ?></td>
            </tr>
            <tr>
                <td><strong>Chief Complaints</strong></td>
                <td><?php echo htmlspecialchars($row['chief_complaints']); ?></td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td><?php echo htmlspecialchars ($row['address']); ?></td>
            </tr>
            <tr>
                <td><strong>Contract Number</strong></td>
                <td><?php echo htmlspecialchars($row['contract_number']); ?></td>
            </tr>
            <tr>
                <td><strong>Religion</strong></td>
                <td><?php echo htmlspecialchars($row['religion']); ?></td>
            </tr>
            <tr>
                <td><strong>Date Time</strong></td>
                <td><?php echo htmlspecialchars($row['date_time']); ?></td>
            </tr>
            <tr>
                <td><strong>Accompanied By</strong></td>
                <td><?php echo htmlspecialchars($row['accompanied_by']); ?></td>
            </tr>
            <tr>
                <td><strong>History Present Illness</strong></td>
                <td><?php echo htmlspecialchars($row['history_present_illness']); ?></td>
            </tr>
            <tr>
                <td><strong>Past Medical History</strong></td>
                <td><?php echo htmlspecialchars($row['past_medical_history']); ?></td>
            </tr>
            <tr>
                <td><strong>Hypertension</strong></td>
                <td><?php echo htmlspecialchars($row['hypertension']); ?></td>
            </tr>
            <tr>
                <td><strong>Hypertension Medications</strong></td>
                <td><?php echo htmlspecialchars($row['hypertension_meds']); ?></td>
            </tr>
            <tr>
                <td><strong>Diabetes</strong></td>
                <td><?php echo htmlspecialchars($row['diabetes']); ?></td>
            </tr>
            <tr>
                <td><strong>Diabetes Medications</strong></td>
                <td><?php echo htmlspecialchars($row['diabetes_meds']); ?></td>
            </tr>
            <tr>
                <td><strong>Asthma</strong></td>
                <td><?php echo htmlspecialchars($row['asthma']); ?></td>
            </tr>
            <tr>
                <td><strong>Asthma Medications</strong></td>
                <td><?php echo htmlspecialchars($row['asthma_meds']); ?></td>
            </tr>
            <tr>
                <td><strong>Occupation</strong></td>
                <td><?php echo htmlspecialchars($row['occupation']); ?></td>
            </tr>
            <tr>
                <td><strong>Smoking</strong></td>
                <td><?php echo htmlspecialchars($row['smoking']); ?></td>
            </tr>
            <tr>
                <td><strong>Pack Years</strong></td>
                <td><?php echo htmlspecialchars($row['pack_years']); ?></td>
            </tr>
            <tr>
                <td><strong>Alcohol</strong></td>
                <td><?php echo htmlspecialchars($row['alcohol']); ?></td>
            </tr>
            <tr>
                <td><strong>Alcohol Frequency</strong></td>
                <td><?php echo htmlspecialchars($row['alcohol_frequency']); ?></td>
            </tr>
            <tr>
                <td><strong>Allergies (Food)</strong></td>
                <td><?php echo htmlspecialchars($row['allergies_food']); ?></td>
            </tr>
            <tr>
                <td><strong>Allergies (Drugs)</strong></td>
                <td><?php echo htmlspecialchars($row['allergies_drugs']); ?></td>
            </tr>
            <tr>
                <td><strong>Allergies (Others)</strong></td>
                <td><?php echo htmlspecialchars($row['allergies_others']); ?></td>
            </tr>
            <tr>
                <td><strong>LMP</strong></td>
                <td><?php echo htmlspecialchars($row['lmp']); ?></td>
            </tr>
            <tr>
                <td><strong>G</strong></td>
                <td><?php echo htmlspecialchars($row['g']); ?></td>
            </tr>
            <tr>
                <td><strong>P</strong></td>
                <td><?php echo htmlspecialchars($row['p']); ?></td>
            </tr>
            <tr>
                <td><strong>OB Others</strong></td>
                <td><?php echo htmlspecialchars($row['ob_others']); ?></td>
            </tr>
            <tr>
                <td><strong>Previous Surgeries</strong></td>
                <td><?php echo htmlspecialchars($row['previous_surgeries']); ?></td>
            </tr>
            <tr>
                <td><strong>BCG</strong></td>
                <td><?php echo htmlspecialchars($row['bcg']); ?></td>
            </tr>
            <tr>
                <td><strong>DPT Polio</strong></td>
                <td><?php echo htmlspecialchars($row['dpt_polio']); ?></td>
            </tr>
            <tr>
                <td><strong>Hepatitis B</strong></td>
                <td><?php echo htmlspecialchars($row['hepatitis_b']); ?></td>
            </tr>
            <tr>
                <td><strong>Measles</strong></td>
                <td><?php echo htmlspecialchars($row['measles']); ?></td>
            </tr>
            <tr>
                <td><strong>Immunization Others</strong></td>
                <td><?php echo htmlspecialchars($row['immunization_others']); ?></td>
            </tr>
            <tr>
                <td><strong>Altered Mental Sensorium</strong></td>
                <td><?php echo htmlspecialchars($row['altered_mental_sensorium']); ?></td>
            </tr>
            <tr>
                <td><strong>Pain</strong></td>
                <td><?php echo htmlspecialchars($row['pain']); ?></td>
            </tr>
            <tr>
                <td><strong>History Category</strong></td>
                <td><?php echo htmlspecialchars($row['history_category']); ?></td>
            </tr>
        </table>
        <?php
    } else {
        echo "No records found.";
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo "Invalid ID.";
}

// Close database connection
$database->close();
?>