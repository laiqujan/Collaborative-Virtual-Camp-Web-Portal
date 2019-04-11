<?php 
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
$f="1";
$ff="0";
$u=$_SESSION['Id'];
$query2 = "select * from notifications where unread='$f' and recipient_id='$u'";
$result2 = $con->query ( $query2 ) or die ( "Query error" );
$query3 = "select * from notifications where unread='$ff' and recipient_id='$u' ORDER by created_at DESC";
$result3 = $con->query ( $query3 ) or die ( "Query error" );
?>
          <a href="#" style="color: white;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
		    <!--SHOW NOTIFICATIONS COUNT.-->
		 	     <div id="noti_Counter"> 
				 <?php
                                foreach ( $con->query ( "SELECT COUNT(*) FROM notifications where unread='$f' and recipient_id='$u'" ) as $row ) {
									if($row ['COUNT(*)']>0){
                                    echo $row ['COUNT(*)'];
									}
                                }
                 ?>
				 </div> 
                <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                <div id="noti_Button" onclick="setStatus();"></div>
            </a>
          <ul class="dropdown-menu notify-drop">
            <div class="notify-drop-title">
            	<div class="row">
            		<div class="col-md-6 col-sm-6 col-xs-6">Updates:</div>
            		<div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="Cvc NOTIFICATIONS"><i class="fa fa-dot-circle-o"></i></a></div>
            	</div>
            </div>
            <!-- end notify title -->
            <!-- notify content -->
            <div class="drop-content">
			<?php foreach ( $result3 as $row2 ) {
				?>
            	<li>
            		<div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
            		<div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="<?php echo $row2['reference']; ?> "><?php echo $row2['des']; ?> </a> 
					 <a href="<?php echo $row2['reference']; ?>" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
            		<hr>
            		<p class="time"><?php echo $row2['created_at']; ?></p>
            		</div>
            	</li>
	
            	<?php }
				?>
            </div>
            <div class="notify-drop-footer text-center">
            	<a href=""><i class="fa fa-eye"></i> Cvc Updates</a>
            </div>
          </ul>
