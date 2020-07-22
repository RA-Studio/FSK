<?
if (isset($_POST['required']) && !empty($_POST['required'])) {
    foreach ($_POST['required'] as $required) {
        foreach ($_POST['data'] as $formData) {
           if ($required === $formData['name']) {
               if (!$formData['value']) {
                   $emptyFiels[] = $formData['name'];
               }
           }
        }
    }

    if (!empty($emptyFiels)) {
        echo json_encode(array(
            'type' => 'required',
            'fields' => $emptyFiels,
            'success' => false
        ));
    } else {
        echo json_encode(array(
            'type' => 'required',
            'success' => true
        ));
    }
} elseif (isset($_POST['data']) && !isset($_POST['required'])) {
    $success = true;
    foreach ($_POST['data'] as $formData) {
        if ($formData['name'] === 'FIELDS[PHONE]') {
            if (!$formData['value']) {
                $success = false;
            }
        }
    }
    if($success) {
        echo json_encode(array(
            'type' => 'all',
            'success' => true
        ));
    } else {
        echo json_encode(array(
            'type' => 'all',
            'success' => false
        ));
    }
}
?>