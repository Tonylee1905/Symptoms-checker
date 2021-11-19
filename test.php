<!DOCTYPE html>
<html xmlns=" HTTP://www.w3.org/1999/xhtml">
<head>
   <title></title>
   <link rel="stylesheet" type="text/css" href="symptom_selector/selector.css?v=1">
   <link rel="stylesheet" type="text/css" href="symptom_selector/fontawesome/assets/css/font-awesome.min.css" />
   <script src="libs/jquery-1.12.2.min.js"></script>
   <script src="libs/json2.js"></script><!--  JSON for ie7 -->
   <script src="libs/jquery.imagemapster.min.js?v=1.1"></script>
   <script src="libs/typeahead.bundle.js"></script>

   <script src="symptom_selector/selector.js?v=3.3"></script>

   <?php

   // session_start(); // this causes some issues with certain servers, try this if it's working with this line or not.

   if ( !isset( $_SESSION['userToken']) || !isset( $_SESSION['tokenExpireTime']) || time() >= $_SESSION['tokenExpireTime'] )
   {
       require 'token_generator.php';
       $tokenGenerator = new TokenGenerator("coinsspot0@gmail.com","b4LBz6y8Y7KjTk5t3","https://sandbox-authservice.priaid.ch/login"); // or for live data https://authservice.priaid.ch
       $token = $tokenGenerator->loadToken();
       $_SESSION['userToken'] = $token->{'Token'};
       $_SESSION['tokenExpireTime'] = time() + $token->{'ValidThrough'};
   }

   $token = $_SESSION['userToken'];
   ?>

   <script type="text/javascript">

       var userToken = <?php echo "'".$token."'" ?>;

      $(document).ready(function () {
          $("#symptomSelector").symptomSelector(
          {
              mode: "diagnosis", // For specialisation only use value "specialisations"
              webservice: "https://sandbox-healthservice.priaid.ch", // for live data https://healthservice.priaid.ch
              language: "en-gb", // You can change language here to de-ch, tr-tr...
              specUrl: "https://Seamhealth.btcfutureapp.com/specialisation", // Here should come url for specialisations doctor search page
              accessToken: userToken //This is where your token is placed
          });
      });
  </script>

</head>
<body>
<h1 style="text-align:center;">Please, tell us a bit about yourself and how you’re feeling for suggested treatment plans.
 </h1><br /><br />
   <table class=" Container-table">
       <tr>
           <td valign="middle" colspan="2" class="td-header box-white bordered-box width50"><h4 class="header" id="selectSymptomsTitle"><span class="badge pull-left badge-primary visible-lg margin5R">1</span></h4></td>
           <td valign="middle" class="td-header bordered-box box-white width25"><h4 class="header" id="selectedSymptomsTitle"><span class="badge pull-left badge-primary visible-lg margin5R">2</span></h4></td>
           <td valign="middle" class="td-header bordered-box box-white width25"><h4 class="header" id="possibleDiseasesTitle"><span class="badge pull-left badge-primary visible-lg margin5R">3</span></h4></td>
       </tr>
       <tr>
           <td valign="top" class="selector_container bordered-box box-white width25"><div id="symptomSelector"></div></td>
           <td valign="top" class="selector_container bordered-box box-white width25"><div id="symptomList"></div></td>
           <td valign="top" class="selector_container bordered-box box-white width25"><div id="selectedSymptomList"></div></td>
           <td valign="top" class="selector_container bordered-box box-white width25"><div id="diagnosisList"></div></td>
       </tr>
   </table>
   <div>
       <a target="_blank" href="http://corporate.priaid.ch"><img class="logo" alt="priaid" src="symptom_selector/images/logo.jpg" /></a>
       <span><a class="priaid-powered" target="_blank" href="http://corporate.priaid.ch"> powered by priaid</a> </span>
   </div>
</body>
</html>