<?

if (isset($_POST['submit'])) {

  $has_file = $_FILES['excel_file']['name'] != '' ? 1 : 0;

  if ($has_file) {

    $destination = $_SERVER['DOCUMENT_ROOT'] . '/tmp';
    $source = $_FILES['excel_file']['tmp_name'];
    $target = "$destination/$source.xls";
    
    move_uploaded_file($source, $target);

    require $_SERVER['DOCUMENT_ROOT'] . '/lib/SimpleXLSX.php';

    if ($xlsx = SimpleXLSX::parse($target)) {
      foreach ($xlsx->rows() as $row) {
        // Insert into database

         $row['Timesheet of'];
         $row['Period'];
         $row['Client'];
         $row['Date'];
         $row['Worked hours'];
         $row['Travelling distance in km'];
         $row['Other'];
         $row['Approved by'];
         $row['Name'];
         $row['Comments'];
      }

      unlink($target);

    } else {
      // Report error
    }

    header('Location: /');
  }
} else {
  header('Location: /');
}
