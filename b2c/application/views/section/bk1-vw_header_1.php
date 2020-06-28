<!DOCTYPE html>
<!--<html lang="en" ng-app="MansionlyApp">-->
<html lang="en" >
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="private, max-age=216000"> 
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<meta name="HandheldFriendly" content="true" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="apple-mobile-web-app-title" content="Phaser App">
<meta name="viewport" content="initial-scale=1 maximum-scale=1 user-scalable=0 minimal-ui" />

<link rel="icon" type="image/png" href="<?php echo base_url().SitePath; ?>assets/img/favicon.png" />


<title><?php if (!empty($page_title)){ echo $page_title;} else { echo "Interior Designers in Delhi, Gurgaon, Noida, Bengaluru and Pune | International Interior Design for Home & Office"; }?></title>
<meta name="description" content="<?php if (!empty($meta_description)) { echo $meta_description; } else { echo "Mansionly offers best home and office interior designers in Delhi and Bengaluru. Find inspirational home and office designs from world’s best designers only at Mansionly"; }?>" />
<meta name="keywords" content="<?php if (!empty($meta_keywords)) { echo $meta_keywords; } else {  echo "Home interior design, office interior design, interior designers in Bengaluru, interior designers in Delhi"; } ?>" />
<!--<meta name="title" content="<?php// if (!empty($meta_title)) { echo $meta_title; } else {  echo "Home interior design, office interior design, interior designers in Bengaluru, interior designers in Delhi"; } ?>" />-->
<meta name="robots" content="index, follow">
<meta name="copyright" content="www.mansionly.com">
<meta name="language" content="EN">
<meta name="rating" content="general">
<!--Canonical Link -->
<?php 
if(isset($canonicalLink))
    {
        echo $canonicalLink;
    }
?>

<!-- Bootstrap -->
<link href="<?php echo base_url().SitePath; ?>assets/css/bootstrap.min.css?v=1.0" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/main.css?v=7.2" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/responsive.css?v=5.6" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/font-awesome.min.css?v=1.0" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/owl.carousel.css?v=1.0" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/jquery.bxslider.css?v=1.0" rel="stylesheet">
<!--<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery.js"></script>-->
<script  type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery-2.1.4.js?v=1.0"></script>
<script  type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery-ui.js?v=1.0"></script>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/angular.min.js?v=1.0"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/angular-route.js?v=1.0"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/module.js?v=1.0"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/app.js?v=1.0"></script>
<!--<script src="<?php// echo base_url().SitePath ; ?>assets/js/owl.carousel.min.js"></script>-->
<script>
        var baseUrl = '<?php echo base_url(); ?>';
        var baseUrlAtt = '<?php echo base_url().SitePath; ?>';
        var custImageUrl = '';
        var sectionlist = '';
        var themelist = '';
</script>

<script>
    var currLoginUserId = '<?php echo isset($_SESSION["customerId"])?$_SESSION["customerId"]:"" ?>';  
</script>

<!--<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/js-analytics.js?v=1.0" ></script>-->
