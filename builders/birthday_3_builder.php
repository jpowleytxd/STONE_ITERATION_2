<?php
ini_set('max_execution_time', 3000);
include 'common.php';

$saveToFile = $_POST['saveStatus'];
$returnString = null;

//Birthday 2
foreach(glob("../sites/*/templates/*_branded.html") as $filename){
  $template = file_get_contents($filename);
  $brand = preg_replace('/.*?\/.*?\/(.*?)\/.*/', '$1', $filename);

  //Get content
  $birthdayRows = null;

  //Table select for content data
  $table = null;
  if($brand === 'common_room'){
    $table = 'copy_iteration2_common_room';
  } else{
    $table = 'copy_iteration2_yates';
  }

  $email ="Birthday -3 weeks";
  $initialQuery = "SELECT * FROM " . $table . " WHERE `email` = '" . $email . "'";
  $rows = databaseQuery($initialQuery);
  foreach($rows as $key => $row){
    $birthdayRows = $row;
    break;
  }

  //Get Background Color
  preg_match('/"contentBackground": "(.*)"/', $template, $matches, PREG_OFFSET_CAPTURE);
  $color = $matches[1][0];
  $textColor = textColor($color);

  //Prep Heading
  $heading = file_get_contents('../sites/' . $brand . '/bespoke_blocks/' . $brand . '_heading.html');
  $heading = str_replace('Heading goes here', $birthdayRows[4], $heading);
  $heading = str_replace('align="left"', 'align="center"', $heading);
  $heading = marginBuilder($heading);
  preg_match('/<h1.*?style="(.*?)".*?>/', $heading, $matches, PREG_OFFSET_CAPTURE);
  $headingStyle = $matches[1][0];
  $headingStyleNew = $headingStyle . ' font-size: 24px;';
  $heading = str_replace($headingStyle, $headingStyleNew, $heading);

  //Prep Image
  $image = file_get_contents('../sites/_defaults/image.html');
  $promo = $image;
  $image = str_replace('http://img2.email2inbox.co.uk/editor/fullwidth.jpg', getURL($brand, 'birthday_3.png'), $image);

  //Prep Spacer
  $emptySpacer = file_get_contents('../sites/_defaults/basic_spacer.html');
  $largeSpacer = str_replace('<td align="center" height="20" valign="middle"></td>', '<td align="center" height="40" valign="middle"></td>', $emptySpacer);

  //Prep All Text
  $basicText = file_get_contents('../sites/_defaults/text.html');
  $textOne = $textTwo = $basicText;
  $font = "Arial, 'Helvetica Neue', Helvetica, sans-serif";

  //Prep Text One
  $birthdayRows[5] = str_replace('"', '', $birthdayRows[5]);
  $textOne = str_replace('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales vehicula tellus pellentesque malesuada. Integer malesuada magna felis, id rutrum leo volutpat eget. Morbi finibus et diam in placerat. Suspendisse magna enim, pharetra at erat vel, consequat facilisis mauris. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla est velit, lobortis eu tincidunt sit amet, semper et lorem.', $birthdayRows[5], $textOne);
  $clickLink = 'http://stonegateemail.co.uk/$dynamic3$/website';
  if($brand === 'common_room'){
    $clickLink = 'http://stonegateemail.co.uk/$dynamic3$/partyenq';
  }
  $linkInsert = '<a href="' . $clickLink . '" style="color: ' . $textColor . '; font-weight: bold; text-decoration: underline;"><span style="color: ' . $textColor . '; font-weight: bold; text-decoration: underline;">find out how we can make it your best ever</span></a>';
  $textOne = str_replace('find out how you can make it your best ever', $linkInsert, $textOne);
  $styleInsert = 'style="Margin-top: 15px; Margin-bottom: 15px;"';
  $textOne = preg_replace('/##(.+?)##/m', '<p ' . $styleInsert . '>$1</p>', $textOne);
  $styleInsert = 'style="color: ' . $textColor . ';font-weight: normal; font-family: ' . $font . ';"';
  $textOne = str_replace('<td class="text" align="left" valign="0">', '<td class="text" align="center" valign="0" ' . $styleInsert . '>', $textOne);
  $textOne = str_replace('<tr>', '<tr><td align="center" width="30"></td>', $textOne);
  $textOne = str_replace('</tr>', '<td align="center" width="30"></td></tr>', $textOne);

  //Prep Promo Image
  $url = getURL($brand, 'drink.png');
  $promo = str_replace('http://img2.email2inbox.co.uk/editor/fullwidth.jpg', $url, $promo);
  $promo = marginBuilder($promo);

  //Prep Voucher
  $voucherInstructions = $birthdayRows[10];
  $voucher = file_get_contents('../sites/' . $brand . '/bespoke_blocks/' . $brand . '_voucher.html');
  $voucherSearch = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
  $voucher = str_replace($voucherSearch, $voucherInstructions, $voucher);
  $voucher = marginBuilder($voucher);

  //Prep Text Two
  $birthdayRows[8] = str_replace('"', '', $birthdayRows[8]);
  $textTwo = str_replace('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sodales vehicula tellus pellentesque malesuada. Integer malesuada magna felis, id rutrum leo volutpat eget. Morbi finibus et diam in placerat. Suspendisse magna enim, pharetra at erat vel, consequat facilisis mauris. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla est velit, lobortis eu tincidunt sit amet, semper et lorem.', $birthdayRows[8], $textTwo);
  $styleInsert = 'style="Margin-top: 15px; Margin-bottom: 15px;"';
  $textTwo = preg_replace('/##(.+?)##/m', '<p ' . $styleInsert . '>$1</p>', $textTwo);
  $clickLink = 'http://stonegateemail.co.uk/$dynamic3$/website';
  if($brand === 'common_room'){
    $clickLink = 'http://stonegateemail.co.uk/$dynamic3$/partyenq';
  }
  $linkInsert = '<a href="' . $clickLink . '" style="color: ' . $textColor . '; font-weight: bold; text-decoration: underline;"><span style="color: ' . $textColor . '; font-weight: bold; text-decoration: underline;">click here</span></a>';
  $textTwo = str_replace('click here', $linkInsert, $textTwo);
  $styleInsert = 'style="color: ' . $textColor . ';font-weight: normal; font-family: ' . $font . ';"';
  $textTwo = str_replace('<td class="text" align="left" valign="0">', '<td class="text" align="center" valign="0" ' . $styleInsert . '>', $textTwo);
  $textTwo = str_replace('<tr>', '<tr><td align="center" width="30"></td>', $textTwo);
  $textTwo = str_replace('</tr>', '<td align="center" width="30"></td></tr>', $textTwo);

  //Get terms font color
  preg_match('/"emailBackground": "(.*)"/', $template, $matches, PREG_OFFSET_CAPTURE);
  $color = $matches[1][0];
  $textColor = textColor($color);

  //Build terms
  $terms = termsBuilder($birthdayRows[9]);
  $styleInsert = 'style="font-size: 11px; color: ' . $textColor . '"';
  $terms = preg_replace('/<td valign="top">/', '<td valign="top" align="center" ' . $styleInsert . '>', $terms);

  //Insert content into template
  $insert = $image . $largeSpacer . $heading . $emptySpacer . $textOne . $largeSpacer . $voucher . $largeSpacer . $textTwo . $largeSpacer;

  if(($brand === "yates") || ($brand === "bosleys")){
    $insert = $image . $largeSpacer . $heading . $emptySpacer . $textOne . $textTwo . $largeSpacer;
  }

  $search = "/<!-- User Content: Main Content Start -->\s*<!-- User Content: Main Content End -->/";
  $output = preg_replace($search, "<!-- User Content: Main Content Start -->" . $insert . "<!-- User Content: Main Content End -->", $template);

  //Insert terms
  $search = "/<!-- terms insert -->/";
  $output = preg_replace($search, $terms, $output);

  $append = "birthday_3_weeks";
  $path = "pre_made";
  $save = $saveToFile;

  sendToFile($output, $path, $append, $brand, '.html', $save);

  // print_r($output);

  $returnString .= $output;
}

echo $returnString;

 ?>
