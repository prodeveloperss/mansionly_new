<?php 
if(!empty($this->session->userdata('scroll_pos'))){ 
   $scroll_pos =  $this->session->userdata('scroll_pos');
   $this->session->unset_userdata('scroll_pos');
?>
<script>
$('html').animate({
    scrollTop: <?php echo $scroll_pos; ?>   
}, 5);
</script>
<?php } ?>