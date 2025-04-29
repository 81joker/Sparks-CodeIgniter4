<?php

if (!function_exists('generateCsvResponse')) {
    function generateCsvResponse($data, $filename = 'data.csv') {
        $response = service('response');
        
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-Disposition', 'attachment; filename="'.$filename.'"');
        
        $output = fopen('php://output', 'w');
        
        if (!empty($data)) {
            fputcsv($output, array_keys((array)$data[0]));
            
            foreach ($data as $row) {
                fputcsv($output, (array)$row);
            }
        }
        
        fclose($output);
        
        return $response;
    }
}