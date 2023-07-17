<?php
$word = array("?", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "=", "|", "]", "[", "{", "}", "/", ">", "<");
$output = str_replace($word, "", md5($row_action_2['nama']));
$judul = preg_replace("/\s/", "-", $output);
$link = "?" . "page" . "=" . $row_action_2['code_pelanggan'] . "-" . $judul . ".html";