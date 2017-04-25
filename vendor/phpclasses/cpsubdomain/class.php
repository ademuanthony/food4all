<?php
/*

Class Name: cpsubdomain
Clas Title: cPanel Subdomains Creator
Purpose: Create cPanel subdomains without logging into cPanel.
Version: 1.0
Author: Md. Zakir Hossain (Raju)
URL: http://www.rajuru.xenexbd.com

Company: Xenex Web Solutions
URL: http://www.xenexbd.com

License: LGPL
You can freely use, modify, distribute this script. But a credit line is appreciated.

Installation:
see example.php for details

Compatibility: PHP4
*/

//definding main class
class cpsubdomain{
  //declare public variables
  var $cpuser;    // cPanel username
  var $cppass;        // cPanel password
  var $cpdomain;      // cPanel domain or IP
  var $cpskin;        // cPanel skin. Mostly x or x2.
  
  //defining constructor
  function cpsubdomain($cpuser,$cppass,$cpdomain,$cpskin='x'){
    $this->cpuser=$cpuser;
	$this->cppass=$cppass;
	$this->cpdomain=$cpdomain;
	$this->cpskin=$cpskin;
	// See following URL to know how to determine your cPanel skin
	// http://www.zubrag.com/articles/determine-cpanel-skin.php
  }
  

  //function for creating subdomain
  
  function createSD($esubdomain){
  	//checking whether the subdomain is exists 
  	$subdomain=$esubdomain.".".$this->cpdomain;
  	$path="http://".$this->cpuser.":".$this->cppass."@".$this->cpdomain.":2082/cpsess1770233093/frontend/".$this->cpskin."/subdomain/index.html";
    $f = fopen($path,"r");
	if (!$f) {
	  return('error');
	}

    //check if the account exists
    while (!feof ($f)) {
	  $line = fgets ($f, 1024);
	  if (ereg ($subdomain, $line, $out)) {
	    return('duplicate');
	  }
	}
	fclose($f); //close the file resource
	

	  //http://myestores.com.ng:2082/cpsess1770233093/frontend/paper_lantern/subdomain/doadddomain.html
	//subdomain does not already exist. So proceed to creating it
    $path="http://".$this->cpuser.":".$this->cppass."@".$this->cpdomain.":2082/cpsess1770233093/frontend/".$this->cpskin."/subdomain/doadddomain.html?domain=".$esubdomain."&rootdomain=".$this->cpdomain."&dir=public_html/stores";
    $f = fopen($path,"r");
	if (!$f) {
	  return('Can\'t open cPanel.');
	}

    //check if the subdomain added
    while (!feof ($f)) {
	  $line = fgets ($f, 1024);
	  if (ereg ("has been created.", $line, $out)) {
	    return('created');
	  }
	}
	fclose($f); //close the file resource
    //return success message
	return "error";
	
 }
}

?>