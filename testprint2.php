<?php

function printIssue()
{
	$your_printer_name = "EPSON LX-300";
	$handle=printer_open($your_printer_name);
//set the font characteristics here
	$font_face = "Draft Condensed";
	$font_height = 20;
	$font_width = 6;
$font=printer_create_font($font_face,$font_height,$font_width,PRINTER_FW_THIN,false,false,false,0);
printer_select_font($handle,$font);
printer_write($handle,"My PDF file content below");
//here loop through your pdf file and print the line by line or else get the entire content inside the string at once and print
$your_pdf_file = "doc.pdf";
	if(!eof($file_handle))
	{
		//do something
		printer_write($handle,$name);
	}
	printer_delete_font($font);
	printer_close($handle);
}


printIssue();
?>