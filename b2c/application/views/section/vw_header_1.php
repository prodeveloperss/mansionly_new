<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Article">
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

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?php if (!empty($page_title)){ echo $page_title;} else { echo "Interior Designers in Delhi, Gurgaon, Noida, Bengaluru and Pune | International Interior Design for Home & Office"; }?>">
<meta itemprop="description" content="<?php if (!empty($meta_description)) { echo $meta_description; } else { echo "Mansionly offers best home and office interior designers in Delhi and Bengaluru. Find inspirational home and office designs from world’s best designers only at Mansionly"; }?>">
<meta itemprop="image" content="<?php echo base_url().SitePath; ?>assets/img/mansionly_200.jpg">

<!-- Twitter Card data -->
<meta name="twitter:card" content="<?php echo base_url().SitePath; ?>assets/img/mansionly_200.jpg">
<meta name="twitter:site" content="<?php echo base_url();?>">
<meta name="twitter:title" content="<?php if (!empty($page_title)){ echo $page_title;} else { echo "Interior Designers in Delhi, Gurgaon, Noida, Bengaluru and Pune | International Interior Design for Home & Office"; }?>">
<meta name="twitter:description" content="<?php if (!empty($meta_description)) { echo $meta_description; } else { echo "Mansionly offers best home and office interior designers in Delhi and Bengaluru. Find inspirational home and office designs from world’s best designers only at Mansionly"; }?>">
<meta name="twitter:creator" content="<?php echo base_url();?>">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?php echo base_url().SitePath; ?>assets/img/mansionly_200.jpg">

<!-- Open Graph data -->
<meta property="og:title" content="<?php if (!empty($page_title)){ echo $page_title;} else { echo "Interior Designers in Delhi, Gurgaon, Noida, Bengaluru and Pune | International Interior Design for Home & Office"; }?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo base_url();?>" />
<meta property="og:image" content="<?php echo base_url().SitePath; ?>assets/img/mansionly_200.jpg" />
<meta property="og:description" content="<?php if (!empty($meta_description)) { echo $meta_description; } else { echo "Mansionly offers best home and office interior designers in Delhi and Bengaluru. Find inspirational home and office designs from world’s best designers only at Mansionly"; }?>" />

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
<link href="<?php echo base_url().SitePath; ?>assets/css/main.css?v=8.7" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/responsive.css?v=6.6" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/font-awesome.min.css?v=1.0" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/owl.carousel.css?v=1.0" rel="stylesheet">
<link href="<?php echo base_url().SitePath; ?>assets/css/jquery.bxslider.css?v=1.0" rel="stylesheet">
<!--<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery.js"></script>-->
<script  type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery-2.1.4.js?v=1.0"></script>
<script  type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/jquery-ui.js?v=1.0" ></script>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/angular.min.js?v=1.0" defer></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/angular-route.js?v=1.0" defer></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/module.js?v=1.0"  defer="defer" ></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().SitePath; ?>assets/js/angular_js/app.js?v=1.0"  defer="defer"  ></script>
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
