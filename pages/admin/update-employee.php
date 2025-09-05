if (isset($_FILES['new_img']) && $_FILES['new_img']['error'] === UPLOAD_ERR_OK) {
  $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/employees/';
  $filename = basename($_FILES['new_img']['name']);
  $targetPath = $uploadDir . $filename;

  // Volitelně: validace typu a velikosti
  $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
  if (in_array($_FILES['new_img']['type'], $allowedTypes)) {
    move_uploaded_file($_FILES['new_img']['tmp_name'], $targetPath);
    $employees[$index]['img'] = '/assets/img/employees/' . $filename;
  }
}