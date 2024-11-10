<?php
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $history_session = isset($_POST['history_session']) ? $_POST['history_session'] : null;
    $patient_name = isset($_POST['patient_name']) ? $_POST['patient_name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : null;
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $cs = isset($_POST['cs']) ? $_POST['cs'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $contract_number = isset($_POST['contract_number']) ? $_POST['contract_number'] : '';
    $religion = isset($_POST['religion']) ? $_POST['religion'] : '';
    $date_time = isset($_POST['date_time']) ? $_POST['date_time'] : null;
    $accompanied_by = isset($_POST['accompanied_by']) ? $_POST['accompanied_by'] : '';
    $chief_complaints = isset($_POST['chief_complaints']) ? $_POST['chief_complaints'] : '';
    $history_present_illness = isset($_POST['history_present_illness']) ? $_POST['history_present_illness'] : '';
    $past_medical_history = isset($_POST['past_medical_history']) ? $_POST['past_medical_history'] : '';
    $hypertension = isset($_POST['hypertension']) ? 'yes' : 'no';
    $hypertension_meds = isset($_POST['hypertension_meds']) ? $_POST['hypertension_meds'] : '';
    $diabetes = isset($_POST['diabetes']) ? 'yes' : 'no';
    $diabetes_meds = isset($_POST['diabetes_meds']) ? $_POST['diabetes_meds'] : '';
    $asthma = isset($_POST['asthma']) ? 'yes' : 'no';
    $asthma_meds = isset($_POST['asthma_meds']) ? $_POST['asthma_meds'] : '';
    $others = isset($_POST['others']) ? 'yes' : 'no';
    $others_meds = isset($_POST['others_meds']) ? $_POST['others_meds'] : '';
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
    $smoking = isset($_POST['smoking']) ? 'yes' : 'no';
    $pack_years = isset($_POST['pack_years']) ? $_POST['pack_years'] : null;
    $alcohol = isset($_POST['alcohol']) ? 'yes' : 'no';
    $alcohol_frequency = isset($_POST['alcohol_frequency']) ? $_POST['alcohol_frequency'] : '';
    $others_social = isset($_POST['others_social']) ? 'yes' : 'no';
    $others_social_detail = isset($_POST['others_social_detail']) ? $_POST['others_social_detail'] : '';
    $pediatric_feeding = isset($_POST['pediatric_feeding']) ? 'yes' : 'no';
    $pediatric_feeding_others = isset($_POST['pediatric_feeding_others']) ? $_POST['pediatric_feeding_others'] : '';
    $allergies_food = isset($_POST['allergies_food']) ? $_POST['allergies_food'] : '';
    $allergies_drugs = isset($_POST['allergies_drugs']) ? $_POST['allergies_drugs'] : '';
    $allergies_others = isset($_POST['allergies_others']) ? $_POST['allergies_others'] : '';
    $lmp = isset($_POST['lmp']) ? $_POST['lmp'] : '';
    $g = isset($_POST['g']) ? $_POST['g'] : '';
    $p = isset($_POST['p']) ? $_POST['p'] : '';
    $ob_others = isset($_POST['ob_others']) ? $_POST['ob_others'] : '';
    $previous_surgeries = isset($_POST['previous_surgeries']) ? $_POST['previous_surgeries'] : '';
    $bcg = isset($_POST['bcg']) ? ' yes' : 'no';
    $dpt_polio = isset($_POST['dpt_polio']) ? 'yes' : 'no';
    $hepatitis_b = isset($_POST['hepatitis_b']) ? 'yes' : 'no';
    $measles = isset($_POST['measles']) ? 'yes' : 'no';
    $immunization_others = isset($_POST['immunization_others']) ? $_POST['immunization_others'] : '';
    $altered_mental_sensorium = isset($_POST['altered_mental_sensorium']) ? 'yes' : 'no';
    $pain = isset($_POST['pain']) ? $_POST['pain'] : '';

    $sql = "INSERT INTO history_sheet (
                patient_name, age, sex, cs, address, contract_number, religion, date_time, accompanied_by, 
                chief_complaints, history_present_illness, past_medical_history, hypertension, hypertension_meds, 
                diabetes, diabetes_meds, asthma, asthma_meds, others, others_meds, occupation, smoking, pack_years, 
                alcohol, alcohol_frequency, others_social, others_social_detail, pediatric_feeding, 
                pediatric_feeding_others, allergies_food, allergies_drugs, allergies_others, lmp, g, p, 
                ob_others, previous_surgeries, bcg, dpt_polio, hepatitis_b, measles, immunization_others, 
                altered_mental_sensorium, pain, history_category
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $database->prepare($sql);
    $stmt->bind_param(
        "sisssssssssssssssssssssssssssssssssssssssssss",
        $patient_name, $age, $sex, $cs, $address, $contract_number, $religion, $date_time, $accompanied_by, 
        $chief_complaints, $history_present_illness, $past_medical_history, $hypertension, $hypertension_meds, 
        $diabetes, $diabetes_meds, $asthma, $asthma_meds, $others, $others_meds, $occupation, $smoking, $pack_years, 
        $alcohol, $alcohol_frequency, $others_social, $others_social_detail, $pediatric_feeding, 
        $pediatric_feeding_others, $allergies_food, $allergies_drugs, $allergies_others, $lmp, $g, $p, 
        $ob_others, $previous_surgeries, $bcg, $dpt_polio, $hepatitis_b, $measles, $immunization_others, 
        $altered_mental_sensorium, $pain, $history_session
    );

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Data inserted successfully.";
        header("Location: patient.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $database->close();
}
?>