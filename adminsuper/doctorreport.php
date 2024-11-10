<?php
require('fpdf/fpdf.php');
include 'conn.php';

function generateInventoryReport($inventoryItems) {

    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    // Set title
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'Season Report', 0, 1, 'C');
    $pdf->Ln(10); 

  
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(200, 220, 255); 
    $pdf->Cell(20, 5, 'Name', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Age', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Sex', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Cs', 1, 1, 'C', true);
    $pdf->Cell(20, 5, 'Address', 1, 1, 'R', true);
    $pdf->Cell(20, 5, 'Number', 1, 1, 'R', true);
    $pdf->Cell(20, 10, 'Religion', 1, 1, 'R', true);
    $pdf->Cell(20, 10, 'Date_Time', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Accompanied_by', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Chief_complaints', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'History_Present_Illness', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Past_Medical_History', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Hypertension', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Hypertension_Meds', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Diabetes', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Diabetes_Meds', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Asthma', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Asthma_Meds', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Others', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Others_Meds', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Occupation', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Smoking', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Pack_Years', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Alcohol', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Alcohol_Frequency', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Others_Social', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Others_Social_Detail', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Pediatric_Feeding', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Pediatric_Feeding_Others', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Allergies_Food', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Allergies_Others', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'lmp', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'G', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'P', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Ob_Others', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'Previous_Surgeries', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'bcg', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'dpt_polio', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'measles', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'immunization_others', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'altered_mental_sensorium', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'pain', 1, 1, 'C', true);
    $pdf->Cell(20, 10, 'history_category', 1, 1, 'C', true);





    $pdf->SetFont('Arial', '', 12);

 
    foreach ($inventoryItems as $item) {
        $pdf->Cell(20, 10, htmlspecialchars($item['patient_name']), 1);
        $pdf->Cell(50, 10, htmlspecialchars($item['age']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($item['sex']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['address']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['contract_number']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['religion']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['date_time']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['accompanied_by']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['chief_complaints']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['history_present_illness']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['past_medical_history']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['hypertension']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['hypertension_meds']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['diabetes']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['diabetes_meds']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['asthma']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['others']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['others_meds']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['occupation']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['smoking']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['pack_years']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['alcohol']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['alcohol_frequency']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['others_social']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['others_social_detail']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['pediatric_feeding']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['pediatric_feeding_others']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['allergies_food']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['allergies_drugs']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['allergies_others']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['g']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['p']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['ob_others']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['previous_surgeries']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['bcg']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['dpt_polio']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['hepatitis_b']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['measles']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['immunization_others']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['altered_mental_sensorium']), 1);
        $pdf->Cell(90, 10, htmlspecialchars($item['history_category']), 1);


        
        $pdf->Ln();
    }

  
    $pdf->Output('D', 'History_Season.pdf'); 
}


$sqlInventory = "SELECT * FROM history_sheet";
$stmtInventory = $conn->prepare($sqlInventory);
$stmtInventory->execute();
$result = $stmtInventory->get_result(); // Get the result set from the prepared statement
$inventoryItems = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array

// Call the function to generate the PDF report
generateInventoryReport($inventoryItems);
