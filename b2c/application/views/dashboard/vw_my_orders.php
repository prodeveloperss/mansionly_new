<?php
$this->load->view('section/vw_header_1');
?>
<?php
$this->load->view('section/vw_header_2');
//print_r($brand_details);

?>
<!--------------[ Middle Section ]------------->

<section class="profile-section">
     <div class="breadcrumb-main">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="#">My Account</a></li>
<!--        <li>Profile</li>-->
      </ol>
    </div>
   <div class="profile-nav">
   		 <div class="container">
         	<ul>
            	<li> <a href="<?php echo base_url();?>profile">Profile </a> </li>	<!-- <span class="countnum">5</span>-->
                <li class="active"> <a href="<?php echo base_url();?>my-orders">My Orders </a> </li>	
                <li> <a href="<?php echo base_url();?>my-favourites">My favourites </a> </li>	<!-- <span class="countnum">5</span>-->
            	<li> <a href="<?php echo base_url();?>signout">Sign Out</a> </li>	
            </ul>
         </div>
   </div> 
    <div class="container">
       
      <div class="myoredrTable">
          <?php if($this->session->userdata('MSG')){ 
           echo $this->session->userdata('MSG');
           $this->session->unset_userdata('MSG');
       } ?>
        <div class="table-responsive">
         <?php if(empty($order_details)) { ?>
            <div class="alert alert-danger">
                <strong>Sorry !</strong> No records found.
            </div>
         <?php } else { ?>
          <table class="table table-bordered">
            <colgroup>
            <col class="col-xs-1">
            <col class="col-xs-3">
            <col class="col-xs-6">
            <col class="col-xs-2">
            </colgroup>
            <thead>
              <tr>
                <th>Sr.No.</th>
                <th>Order number</th>
                <th>Address</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php  $i = 1 ;foreach ($order_details as $row) { 
                 
                ?>
               <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['unique_oid']; ?></td>
                <?php
                $address = '';
                 if(!empty($row['apartment'])){
                  $address.= $row['apartment'];
                }   
                if(!empty($row['scheme'])){
                  $address.= ' '.$row['scheme'];
                }    
                if(!empty($row['flat'])){
                  $address.= ' - '.$row['flat'].'<br>';
                }    
                if(!empty($row['apartment_address'])){
                  $address.= ' '.$row['apartment_address'];
                }    
//                if(!empty($row['city'])){
//                  $address.= ' '.$row['city'];
//                }    
                        ?>
                <td><?php echo $address ? $address :'NA' ; ?></td>
                <td>
                    <a href="<?php echo base_url().'work-order-details/'.$row['o_id']; ?>">View status</a>
                </td>
              </tr>
            <?php $i++;  } ?>
            </tbody>
          </table>
         <?php } ?>
        </div>
      </div>
    </div>
  </section>


<?php
$this->load->view('section/vw_footer');
?>