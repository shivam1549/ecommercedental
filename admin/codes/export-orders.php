<?php
include('../../config/app.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once('../controllers/CategoryController.php');
include_once('../controllers/OrderController.php');
include_once('../controllers/ProductController.php');
require '../phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
if (isset($_POST['export'])) {
    $ext = $_POST['file_type'];
    $filename = "orders-sheet-".time();
    $getorder = new OrderController;
    $data = $getorder->export();
    if($data){
       
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'orderNumber');
        $sheet->setCellValue('C1', 'status');
        $sheet->setCellValue('D1', 'ordered_on');
        $sheet->setCellValue('E1', 'total');
        $sheet->setCellValue('F1', 'payment_info');
        $sheet->setCellValue('G1', 'ship_firstname');
        $sheet->setCellValue('H1', 'ship_lastname');
        $sheet->setCellValue('I1', 'ship_email');
        $sheet->setCellValue('J1', 'ship_phone');
        $row_count =2;
        foreach($data as $order_data){
        $sheet->setCellValue('A' . $row_count, $order_data['id']);
        $sheet->setCellValue('B' . $row_count, $order_data['order_number']);
        $sheet->setCellValue('C' . $row_count, $order_data['status']);
        $sheet->setCellValue('D' . $row_count, date("m-d-Y", strtotime($order_data["ordered_on"])));
        $sheet->setCellValue('E' . $row_count, $order_data['total']);
        $sheet->setCellValue('F' . $row_count, $order_data['payment_info']);
        $sheet->setCellValue('G' . $row_count, $order_data['ship_firstname']);
        $sheet->setCellValue('H' . $row_count, $order_data['ship_lastname']);
        $sheet->setCellValue('I' . $row_count, $order_data['ship_email']);
        $sheet->setCellValue('J' . $row_count, $order_data['ship_phone']);  $row_count++;
        }
         
        if($ext == 'xlsx'){
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename.'.xlsx';
        }
        elseif($ext == 'xlsx'){
            $writer = new Xls($spreadsheet);
            $final_filename = $filename.'.xls';
        }
         elseif($ext == 'csv'){
            $writer = new Csv($spreadsheet);
            $final_filename = $filename.'.csv';
        }
        // $writer->save($final_filename);
        header('Content-Type:application/vmd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($final_filename) .'"');
         $writer->save('php://output');
        }
    
    else{
        redirect("NO data found", "admin/orders.php");
        return false;
    }
}





if (isset($_POST['exportproducts'])) {
    $ext = $_POST['file_type'];
    $filename = "Products-sheet-".time();
    $getproducts = new ProductController;
    $data = $getproducts->export();
    if($data){
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'name');
        $sheet->setCellValue('C1', 'price');
        $sheet->setCellValue('D1', 'regular price');
        $sheet->setCellValue('E1', 'Quantity');
        $sheet->setCellValue('F1', 'Sku');
        $sheet->setCellValue('G1', 'Published On');
        $row_count =2;
        foreach($data as $prod_data){
        $sheet->setCellValue('A' . $row_count, $prod_data['id']);
        $sheet->setCellValue('B' . $row_count, $prod_data['name']);
        $sheet->setCellValue('C' . $row_count, $prod_data['price']);
        $sheet->setCellValue('D' . $row_count, $prod_data['regular_price']);
        $sheet->setCellValue('E' . $row_count, $prod_data['quantity']);
        $sheet->setCellValue('F' . $row_count, $prod_data['sku']);
        $sheet->setCellValue('G' . $row_count, date("m-d-Y", strtotime($prod_data["added_on"])));
    $row_count++;
        }
         
        if($ext == 'xlsx'){
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename.'.xlsx';
        }
        elseif($ext == 'xlsx'){
            $writer = new Xls($spreadsheet);
            $final_filename = $filename.'.xls';
        }
         elseif($ext == 'csv'){
            $writer = new Csv($spreadsheet);
            $final_filename = $filename.'.csv';
        }
        // $writer->save($final_filename);
        header('Content-Type:application/vmd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($final_filename) .'"');
         $writer->save('php://output');
        }
    
    else{
        redirect("NO data found", "admin/products.php");
        return false;
    }
}