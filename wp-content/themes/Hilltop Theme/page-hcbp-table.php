<?php
/*
Template Name: HCBP Table Page Template
*/

get_header(); ?>

<style>
	.dynamic-content {
    display:none;
}
	
	.show {
		display:block;
	}
	
		input.check[type="checkbox"]  {
   background: radial-gradient(circle at center, #1062a4 .6ex, white .7ex);
}
 
	input.check[type="checkbox"]:checked  {
   background: radial-gradient(circle at center, #1062a4 .6ex, white .7ex);
}
	
	
	tr td #cbrbox1:checked ~ tr td#cbrmap {
    background-color:green;
}
	
		tr td #cbrbox2:checked ~ tr td#cbrmap {
    background-color:green;
}


	
	


</style>





	
	<?php while( have_posts() ): the_post(); /* start main loop */ ?>

<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left hcbpheaderphoto et_pb_fullwidth_header_0 pubs" style="background-color:#006D75;">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header"><?php the_title(); ?></h1>
						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>


	<?php //TODO: Need to edit the classes: container, containerwide, and content for layout ?>

        
        <?php $i = 0; ?>	
        <?php 

	
			
			  global $wpdb;
       // $table_name = '{$wpdb->prefix}statesTable'; // do not forget about tables prefix
			$cbrchecks = "";

			$mmcbrcheck = "";
			$cbrrcheck = "";
			$chnacheck = "";
			$cbpischeck = "";
			$fapcheck = "";
			$fapdcheck = "";
			$lcbccheck = "";

$cbrcondchecked = "";
			$cbruncondchecked = "";
			$mmcbrchecked = "";
			$cbrrchecked = "";
			$chnachecked = "";
			$cbpischecked = "";
			$fapchecked = "";
			$fapdchecked = "";
			$lcbcchecked = "";


if (isset($_POST['SubmitCompare'])) {
	
	

				
				if (isset($_POST['StateList'])) {
   // $selectedstates = $_POST['StateList'];
					
    // $selectedstates is an array of selected values
					
					$query = 'SELECT * FROM `wp_statesTable` 
         WHERE `stID` IN (' . implode(',', $_POST['StateList']) . ')';
				}
				
				
}
			
else {
			$cbrchecks = "";

			$mmcbrcheck = "";
			$cbrrcheck = "";
			$chnacheck = "";
			$cbpischeck = "";
			$fapcheck = "";
			$fapdcheck = "";
			$lcbccheck = "";
			$itecheck = "";
			$stecheck = "";
	
		$cbrcondchecked = "";
			$cbruncondchecked = "";
			$mmcbrchecked = "";
			$cbrrchecked = "";
			$chnachecked = "";
			$cbpischecked = "";
			$fapchecked = "";
			$fapdchecked = "";
			$lcbcchecked = "";


		$query = "SELECT * FROM wp_statesTable"; 
		
		$x=$_GET["select"];
		if ($x=="0") {$query=$query." ORDER BY StateDesc ";}	
		if ($x=="cbr2") {$query=$query." WHERE cbr = 2 ORDER BY StateDesc ";
										$cbrchecks = "checked";
}
		if ($x=="cbr3") {$query=$query." WHERE cbr = 3 ORDER BY StateDesc ";
										$cbrchecks = "checked";
}	
		if ($x=="mmcbr") {$query=$query." WHERE mmcbr = 1 ORDER BY StateDesc ";
						 		$mmcbrcheck = "checked";
}	
		if ($x=="cbrr") {$query=$query." WHERE cbrr = 1 ORDER BY StateDesc ";
								$cbrrcheck = "checked";
}	
		if ($x=="chna") {$query=$query." WHERE chna = 1 ORDER BY StateDesc ";
								$chnacheck = "checked";
}	
		if ($x=="cbpis") {$query=$query." WHERE cbpis = 1 ORDER BY StateDesc ";
						 		$cbpischeck = "checked";
}	
		if ($x=="fap") {$query=$query." WHERE fap = 1 ORDER BY StateDesc ";
					   		$fapcheck = "checked";
}
		if ($x=="fapd") {$query=$query." WHERE fapd = 1 ORDER BY StateDesc ";
								$fapdcheck = "checked";
}	
		if ($x=="lcbc") {$query=$query." WHERE lcbc = 1 ORDER BY StateDesc ";
								$lcbccheck = "checked";
}
		if ($x=="ite1") {$query=$query." WHERE ite = 1 ORDER BY StateDesc ";
						$itecheck = "checked";
						}	
		if ($x=="ite2") {$query=$query." WHERE ite = 2 ORDER BY StateDesc ";
						$itecheck = "checked";
						}	
		if ($x=="ste1") {$query=$query." WHERE ste = 1 ORDER BY StateDesc ";
						$stecheck = "checked";
						}		
		if ($x=="ste2") {$query=$query." WHERE ste = 2 ORDER BY StateDesc ";
						$stecheck = "checked";
						}		

		if (isset($_POST['SubmitFilter'])) {
			
			

 
			$query=$query." WHERE 1=1 ";
						
			if (!empty($_POST['sel'])) {
				



			$selects = $_POST['sel'];	
		
		if ((in_array("cbr_cond", $selects)) && (in_array("cbr_uncond", $selects)))  {
		$query=$query." AND (cbr = 2 or cbr = 3) ";
			 $cbrcondchecked = "checked='checked'";
			$cbruncondchecked = "checked='checked'";
				$cbrchecks = "checked";

		} elseif (in_array("cbr_uncond", $selects)) {
		$query=$query." AND cbr = 2 ";
			 $cbruncondchecked = "checked='checked'";
				$cbrchecks = "checked";

		} elseif  (in_array("cbr_cond", $selects)) {
		$query=$query." AND cbr = 3 ";
			 $cbrcondchecked = "checked='checked'";
				$cbrchecks = "checked";

		}							else {}
				
					
	if (in_array("mmcbr", $selects)) {
				

	$query=$query." AND mmcbr=1 ";
		$mmcbrcheck = "checked";
		$mmcbrchecked = "checked='checked'";


	}						 
	if (in_array("cbrr", $selects)) {
		
			$query=$query." AND cbrr=1 ";
		$cbrrcheck = "checked";
		$cbrrchecked = "checked='checked'";


	}	
				 		
		if (in_array("chna", $selects)) {
				

	$query=$query." AND chna=1 ";
		$chnacheck = "checked";
		$chnachecked = "checked='checked'";

	}	
		if (in_array("cbpis", $selects)) {
				

	$query=$query." AND cbpis=1 ";
		$cbpischeck = "checked";
		$cbpischecked = "checked='checked'";


	}	
		if (in_array("fap", $selects)) {
				

	$query=$query." AND fap=1 ";
		$fapcheck = "checked";
		$fapchecked = "checked='checked'";


	}	
		if (in_array("fapd", $selects)) {
				

	$query=$query." AND fapd=1 ";
		$fapdcheck = "checked";
		$fapdchecked = "checked='checked'";


	}	
		if (in_array("lcbc", $selects)) {
				

	$query=$query." AND lcbc=1 ";
		$lcbccheck = "checked";
		$lcbcchecked = "checked='checked'";


	}	
	"ORDER BY StateDesc";

			}
			
		}
	
	//TODO: Need to program the conditional statements below for Filter Requirements function		
	//<cfif select EQ 'req'>
		//WHERE 1=1 
		//<cfif isdefined("form.sel_cbr_uncond") AND isdefined("form.sel_cbr_cond")>
		//	AND (cbr = 2 or cbr = 3)
		//<cfelse>
		//	<cfif isdefined("form.sel_cbr_uncond")>AND cbr = 2</cfif>
		//	<cfif isdefined("form.sel_cbr_cond")>AND cbr = 3</cfif>
		//</cfif>		
		//<cfif isdefined("form.sel_mmcbr")>AND mmcbr = 1</cfif>
		//<cfif isdefined("form.sel_cbrr")>AND cbrr = 1</cfif>
		//<cfif isdefined("form.sel_chna")>AND chna = 1</cfif>
		//<cfif isdefined("form.sel_cbpis")>AND cbpis = 1</cfif>
		//<cfif isdefined("form.sel_fap")>AND fap = 1</cfif>
		//<cfif isdefined("form.sel_fapd")>AND fapd = 1</cfif>
		//<cfif isdefined("form.sel_lcbc")>AND lcbc = 1</cfif>
	//</cfif>

}
       	$states = $wpdb->get_results($query);
			
			?>

	<div class="container hcbp">
		<div id="content-area" class="clearfix">
    
    <div id="containerwide">

	<div class="content">
		<br />
		<!-- <div class="header2">Community Benefit State Law Profiles Comparison</div>  -->
		<div class="header3"><em>State Community Benefit Requirements and Tax Exemptions for Nonprofit Hospitals</em></div>

		<table border="1" cellpadding="4" cellspacing="0" bordercolor="black">
			<tr>
				<td colspan="15" bgcolor="#FFFFAA" align="left">To see which states have a particular requirement, click on  a symbol in the yellow row. You may also filter the requirements by selecting checkboxes in the Filter row and clicking on the Filter Requirements button. For detailed information about the requirement of a particular state, click on the symbol in the field at the intersection of the state's row and the requirement&rsquo;s column. For example, to read about Alabama's financial assistance policy dissemination requirement, click on the square in the field at the intersection of the Alabama row and the Financial Assistance Policy Dissemination column to display the relevant text from the Alabama profile in a pop-up window.</td>
			</tr>
		
			<tr>
				<td colspan="2" valign="bottom" align="center">
				<br/><a href="/wp-content/uploads/hcbp/HCBP_Profiles_Table.mp4" target="_blank" style="color:#d97310;"><strong>Instructional Video</strong></a><br/>
				------------------------<br/>
				<a href="/hcbp-state-comparison?select=0">Select All States</a></td>
				<td colspan="4" valign="top">
					&nbsp; <img src="/wp-content/uploads/hcbp/image_circle_fill.gif"> &nbsp; Unconditional community benefit requirement<br />
					&nbsp; <img src="/wp-content/uploads/hcbp/image_circle_open.gif"> &nbsp; Conditional community benefit requirement<br />
					&nbsp; <img src="/wp-content/uploads/hcbp/image_square_black.gif"> &nbsp; Requirement (either conditional or unconditional)<br />
					&nbsp; Blank = &nbsp; No requirement
				</td>
				<td colspan="4" valign="top">
					<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0" align="left">
					 &nbsp; &nbsp; Click map icon to see which states
					 <br/>
					  &nbsp; &nbsp; have that particular requirement 
				</td>
				<td width="1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td colspan="4" valign="top">
					&nbsp; <img src="/wp-content/uploads/hcbp/image_square_gray.gif"> &nbsp; State tax exemption<br />
					&nbsp; <img src="/wp-content/uploads/hcbp/image_x.gif">	&nbsp; No state tax exemption<br />
					&nbsp; Blank = &nbsp;State does not impose<br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;this tax
				</td>
			</tr>
	<form action="/hcbp-state-comparison/" method="post" name="req" id="REQ">	
	
			<tr class="headerCell">
				<td align="middle" valign="bottom">&nbsp;Compare&nbsp;</td>
				
				<td align="left" valign="bottom">State</td>

				<td align="center" valign="bottom" id="cbrmap" class="<?php echo $cbrchecks; ?>">Community Benefit Requirement<br>
				<a href="#" class="cbrmap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="mmcbrmap" class="<?php echo $mmcbrcheck; ?>">Minimum Community Benefit Requirement<br>
				<a href="#" class="mmcbrmap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="cbrrmap" class="<?php echo $cbrrcheck; ?>">Community Benefit Reporting Requirement<br>
				<a href="#" class="cbrrmap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="chnamap" class="<?php echo $chnacheck; ?>">Community Health Needs Assessment<br>
				<a href="#" class="chnamap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="cbpismap" class="<?php echo $cbpischeck; ?>">Community Benefits Plan/ Implementation Strategy<br>
				<a href="#" class="cbpismap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="fapmap" class="<?php echo $fapcheck; ?>">Financial Assistance Policy<br>
				<a href="#" class="fapmap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="fapdmap" class="<?php echo $fapdcheck; ?>">Financial Assistance Policy Dissemination<br>
				<a href="#" class="fapdmap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td align="center" valign="bottom" id="lcbcmap" class="<?php echo $lcbccheck; ?>">Limitations on Charges, Billing, and Collections<br>
				<a href="#" class="lcbcmap" >
				<img src="/wp-content/uploads/hcbp/usmap_sm.gif" border="0"></a></td>
				
				<td width="-1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td align="center" valign="bottom" class="<?php echo $itecheck; ?>">Income Tax Exemption</td>
				<td align="center" valign="bottom">Property Tax Exemption</td>
				<td align="center" valign="bottom" class="<?php echo $stecheck; ?>">Sales Tax Exemption</td>				
			</tr>
			

			<tr>
				<td align="right" valign="middle">&nbsp; </td>
				<td align="right" valign="middle">Filter: &nbsp; </td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="cbr_cond" id="cbrbox1" class="cbrbox" <?php echo $cbrcondchecked; ?>> &nbsp; 
					<input type="checkbox" name="sel[]" id="cbrbox2" value="cbr_uncond" class="cbrbox" <?php echo $cbruncondchecked; ?>>
				</td>

				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="mmcbr" class="check" <?php echo $mmcbrchecked; ?>>
				</td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="cbrr" class="check" <?php echo $cbrrchecked; ?>>		</td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="chna"class="check" <?php echo $chnachecked; ?>>			</td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="cbpis" class="check" <?php echo $cbpischecked; ?>>
				</td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="fap" class="check" <?php echo $fapchecked; ?>>
				</td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="fapd" class="check" <?php echo $fapdchecked; ?>>
				</td>
				<td align="center" valign="middle">
					<input type="checkbox" name="sel[]" value="lcbc" class="check" <?php echo $lcbcchecked; ?>>
				</td>
				<td width="1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td align="center" valign="middle">&nbsp;</td>
				<td align="center" valign="middle">&nbsp;</td>
				<td align="center" valign="middle">&nbsp;</td>
			</tr>
			
			<tr bgcolor="#FFFFAA">
				<td align="right" valign="middle">&nbsp; </td>
				<td align="right" valign="middle">Select: &nbsp; </td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=cbr3"><img src="/wp-content/uploads/hcbp/image_circle_fill.gif" border="0"></a>
				&nbsp; &nbsp; 
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=cbr2"><img src="/wp-content/uploads/hcbp/image_circle_open.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=mmcbr"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=cbrr"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=chna"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=cbpis"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=fap"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=fapd"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">
				<a href="<?php echo get_permalink( $post->ID ); ?>?select=lcbc"><img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
				</td>
				<td width="1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td align="center" valign="middle">
					<a href="<?php echo get_permalink( $post->ID ); ?>?select=ite1"><img src="/wp-content/uploads/hcbp/image_square_gray.gif" border="0"></a> &nbsp; &nbsp; 
					<a href="<?php echo get_permalink( $post->ID ); ?>?select=ite2"><img src="/wp-content/uploads/hcbp/image_x.gif" border="0"></a>
				</td>
				<td align="center" valign="middle">&nbsp;</td>
				<td align="center" valign="middle">
					<a href="<?php echo get_permalink( $post->ID ); ?>?select=ste1"><img src="/wp-content/uploads/hcbp/image_square_gray.gif" border="0"></a> &nbsp; &nbsp; 
					<a href="<?php echo get_permalink( $post->ID ); ?>?select=ste2"><img src="/wp-content/uploads/hcbp/image_x.gif" border="0"></a>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="center" valign="middle"></td>
				<td align="center" colspan="8">
				<input type="submit" name="SubmitFilter" value="                                       				Filter Requirements                                                     "></td>
				<td width="1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td colspan="3" align="center" valign="middle"></td>
			</tr>
</form>
	

<form action="" method="post" name="Compare" id="STATES">	
			
			<?php
							
			$ite= $state->ite_text;	
	$cbpis= $state->cbpis_text;

         foreach($states as $state){										 
	?>	

		
			<tr align="center" id="<?php echo $i ?>">
				<td><input type="checkbox" name="StateList[<?php echo $state->stID; ?>]" value="<?php echo $state->stID ?>"></td>
				<td align="left">
					<a href="/wp-content/uploads/hcbp/hcbp_docs/HCBP_CBL_<?php echo $state->stateID; ?>.pdf" target="_blank"><?php echo $state->stateDesc ?></a>
				</td>
				<td>
					<?php if ($state->cbr=='2')  {?>
						<a href="#" class="cbrtext" id="cbrlink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_circle_open.gif" border="0" onclick="alert(Test This)"></a>
					<?php } ?>
					<?php if ($state->cbr=='3')  {?>
						<a href="#" class="cbrtext" id="cbrlink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_circle_fill.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->cbr=='0')  {?>
					&nbsp;
					<?php } $cbrby  = stripslashes($state->cbr_text);
					?>
					<script type="text/javascript">
			
 					jQuery(document).ready(function() {
	 
	 				jQuery('a#cbrlink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
						

					jQuery('#cbr_<?php echo $state->stateID ?>').modal();

	
					})
						});
					</script>
	 
					
					<div id="cbr_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="cbrstate"><?php echo $state->stateDesc ?></h1>
						<h4>Community Benefit Requirement</h4>
						<div id="cbrtext"><p><?php echo html_entity_decode($cbrby); ?></p></div>
					</div>
					</div>
		
				</td>
				<td>
					<?php if ($state->mmcbr=='1')  {?>
						<a href="#" class="mmcbrtext" id="mmcbrlink_<?php echo $state->stateID ?>"  >
						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->mmcbr=='0')  {?>
					&nbsp;
					<?php } $mmcbrby  = stripslashes($state->mmcbr_text); ?>
						<script type="text/javascript">
			
 					jQuery(document).ready(function() {
	 
	 				jQuery('a#mmcbrlink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
						

					jQuery('#mmcbr_<?php echo $state->stateID ?>').modal();

	
					})
						});
					</script>
	 
					
					<div id="mmcbr_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Minimum Community Benefit Requirement</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($mmcbrby); ?></p></div>
					</div>
					</div>
				</td>
				
				<td>
					<?php if ($state->cbrr=='1')  {?>
						<a href="#" class="cbrrtext" id="cbrrlink_<?php echo $state->stateID ?>"  >
						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->cbrr=='0')  {?>
					&nbsp;
					<?php } $cbrrby  = stripslashes($state->cbrr_text); ?>
					<script type="text/javascript">
			
 					jQuery(document).ready(function() {
	 
	 				jQuery('a#cbrrlink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
						

					jQuery('#cbrr_<?php echo $state->stateID ?>').modal();

	
					})
						});
					</script>
	 
					
					<div id="cbrr_<?php echo $state->stateID; ?>" class="dynamic-content modal">
						
					<div class="float"><div class="closer"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Community Benefit Reporting Requirement</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($cbrrby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->chna=='1')  {?>
						<a href="#" class="chnatext" id="chnalink_<?php echo $state->stateID ?>"  >
						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->chna=='0')  {?>
					&nbsp;
					<?php } $chnaby  = stripslashes($state->chna_text); ?>	
					
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#chnalink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#chna_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="chna_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Community Health Needs Assessment</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($chnaby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->cbpis=='1')  {?>
					<a href="#" class="cbpistext"  id="cbpislink_<?php echo $state->stateID ?>" >

						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->cbpis=='0')  {?>
					&nbsp;
					<?php } $cbpisby  = stripslashes($state->cbpis_text); ?>	
					
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#cbpislink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#cbpis_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="cbpis_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Community Benefits Plan/ Implementation Strategy</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($cbpisby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->fap=='1')  {?>
						<a href="#" class="faptext"  id="faplink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->fap=='0')  {?>
					&nbsp;
					<?php } $fapby  = stripslashes($state->fap_text); ?>
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#faplink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#fap_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="fap_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Financial Assistance Policy</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($fapby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->fapd=='1')  {?>
						<a href="#" class="fapdtext"  id="fapdlink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->fapd=='0')  {?>
					&nbsp;
					<?php } $fapdby  = stripslashes($state->fapd_text); ?>	
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#fapdlink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#fapd_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="fapd_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Financial Assistance Policy Dissemination</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($fapdby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->lcbc=='1')  {?>
						<a href="#" class="lcbctext"  id="lcbclink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_square_black.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->lcbc=='0')  {?>
					&nbsp;
					<?php } $lcbcby  = stripslashes($state->lcbc_text); ?>		
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#lcbclink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#lcbc_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="lcbc_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Limitations on Charges, Billing, and Collections</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($lcbcby); ?></p></div>
					</div>
					</div>
				</td>
				<td width="1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td>
					<?php if ($state->ite=='1')  {?>
						<a href="#" class="itetext"  id="itelink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_square_gray.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->ite=='2')  {?>
						<a href="#" class="itetext"  id="itelink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_x.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->ite=='0')  {?>
					&nbsp;
					<?php } $iteby  = stripslashes($state->ite_text); ?>		
					
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#itelink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#ite_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="ite_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float">	<div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Income Tax Exemption</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($iteby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->pte=='1')  {?>
						<a href="#" class="ptetext" id="ptelink_<?php echo $state->stateID ?>" >
						<img src="/wp-content/uploads/hcbp/image_square_gray.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->pte=='2')  {?>
						<a href="#" class="ptetext" id="ptelink_<?php echo $state->stateID ?>"  >
						<img src="/wp-content/uploads/hcbp/image_x.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->pte=='0')  {?>
					&nbsp;
					<?php } $pteby  = stripslashes($state->pte_text); ?>		
					
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#ptelink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#pte_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="pte_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Property Tax Exemption</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($pteby); ?></p></div>
					</div>
					</div>
				</td>
				<td>
					<?php if ($state->ste=='1')  {?>
					<a href="#" class="stetext" id="stelink_<?php echo $state->stateID ?>"  >
						<img src="/wp-content/uploads/hcbp/image_square_gray.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->ste=='2')  {?>
					<a href="#" class="stetext" id="stelink_<?php echo $state->stateID ?>"  >						
						<img src="/wp-content/uploads/hcbp/image_x.gif" border="0"></a>
					<?php } ?>
					<?php if ($state->ste=='0')  {?>
					&nbsp;
					<?php } $steby  = stripslashes($state->ste_text); ?>			
					
					<script type="text/javascript">		
 					jQuery(document).ready(function() { 
	 				jQuery('a#stelink_<?php echo $state->stateID ?>').click(function(e) {
       					e.preventDefault();
					jQuery('#ste_<?php echo $state->stateID ?>').modal();
					})
						});
					</script>
	 
					
					<div id="ste_<?php echo $state->stateID; ?>" class="dynamic-content modal">
					<div class="float"><div class="closer icon_close_alt"></div>
						<h1 id="state"><?php echo $state->stateDesc ?></h1>
						<h4>Sales Tax Exemption</h4>
						<div id="bdytext"><p><?php echo html_entity_decode($steby); ?></p></div>
					</div>
					</div>
				</td>
			</tr>
            
		
		<?php	  if ($i == 14 OR $i == 28 OR $i == 42)  { ?>
      
			<tr class="headerCell">
				<td align="middle" valign="bottom">&nbsp;Compare&nbsp;</td>
				<td align="left" valign="bottom">State</td>
				<td align="center" valign="bottom">Community Benefit Requirement<br>
				<td align="center" valign="bottom">Minimum Community Benefit Requirement<br>
				<td align="center" valign="bottom">Community Benefit Reporting Requirement<br>
				<td align="center" valign="bottom">Community Health Needs Assessment<br>
				<td align="center" valign="bottom">Community Benefits Plan/ Implementation Strategy<br>
				<td align="center" valign="bottom">Financial Assistance Policy<br>
				<td align="center" valign="bottom">Financial Assistance Policy Dissemination<br>
				<td align="center" valign="bottom">Limitations on Charges, Billing, and Collections<br>
				<td width="1" bgcolor="white" bordercolor="white" bordercolorlight="white"></td>
				<td align="center" valign="bottom">Income Tax Exemption</td>
				<td align="center" valign="bottom">Property Tax Exemption</td>
				<td align="center" valign="bottom">Sales Tax Exemption</td>				
			</tr>

		            	<?php
			};
						
					 $i++;	 }   ?>

			
		</table>
		<br />
		<input type="submit" name="SubmitCompare" value="    Compare States    ">
		</form>	
		
	<br /><br />
		
		<script type="text/javascript">
			
			function ChangeColor(color) {
    var cbrmap = document.getElementsById("cbrmap")[0];
    cbrmap.style.backgroundColor = color;
}

document.getElementById("cbrbox1").onclick = function() { 
	ChangeColor("rgb(51, 51, 51)"); 
	 }
document.getElementById("cbrbox2").onclick = function() { 
	ChangeColor("rgb(51, 51, 51)"); 
	 }

			
			
 jQuery(document).ready(function() {
	 
	 
// CBR MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.cbrmap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#cbr_map').modal();

	})
	 
// MMCBR MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.mmcbrmap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#mmcbr_map').modal();
	
	})
	 
// CBRR MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.cbrrmap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#cbr_map').modal();


	})
	 
// CHNA MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.chnamap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#chna_map').modal();


	})
	 

// CBPIS MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.cbpismap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#cbpis_map').modal();


	})	 
	 
// FAP MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.fapmap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#fap_map').modal();
		 
		 jQuery('.dynamic-content').dialog({
            modal: true,
            autoOpen: false,
            buttons: {
                Ok: function () {
                    $(this).dialog("close");
                }
            }
        });


	})
	 
// FAPD MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.fapdmap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#fapd_map').modal();


	})
	 
// LCBC MAP POPUP CONTAINER DIV CODE	 

	 jQuery('a.lcbcmap').click(function(e) {
       e.preventDefault();

var stename = jQuery(this).attr("data-state");
var stecontent = jQuery(this).attr("data-text");
 //jQuery('.dynamic-content.show').removeClass('show');

		jQuery('#lcbc_map').modal();


	})
	 
	 
	 

});
</script>
		
<!-- CBR MAP POPUP -->
<div id="cbr_map" class="dynamic-content modal">
		<div class="float2">
	<p>
		<img src="/wp-content/uploads/hcbp/usmap_cbr.gif" alt="Community Benefit Requirement Map" /></p>
	</p>			
	</div>
</div>		
		
<!-- MMCBR MAP POPUP -->
<div id="mmcbr_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_mmcbr.gif" alt="Minimum Community Benefit Requirement Map" />
	</p>			
	</div>
</div>	
		
		
<!-- CBRR MAP POPUP -->
<div id="cbrr_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_cbrr.gif" alt="Community Benefit Reporting Requirement" />
	</p>			
	</div>
</div>		
		
<!-- CHNA MAP POPUP -->
<div id="chna_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_chna.gif" alt="Community Health Needs Assessment" />
	</p>			
	</div>
</div>	
		
<!-- CBPIS MAP POPUP -->
<div id="cbpis_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_cbpis.gif" alt="Community Benefits Plan/Implementation Strategy" />
				</p>
	</div>
</div>	
		
<!-- FAP MAP POPUP -->
<div id="fap_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_fap.gif" alt="Financial Assistance Policy" />
				</p>
	</div>
</div>	
	
<!-- FAPD MAP POPUP -->
<div id="fapd_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_fapd.gif" alt="Financial Assistance Policy Dissemination" />
				</p>
	</div>
</div>	
		
<!-- LCBC MAP POPUP -->
<div id="lcbc_map" class="dynamic-content modal">
		<div class="float2">
<p>
	<img src="/wp-content/uploads/hcbp/usmap_lcbc.gif" alt="Limitations on Charges, Billing, and Collections" />
			</p>	
	</div>
</div>	
		
		
		
		

				
	</div>	
</div> <!-- #content-area -->
	
		</div>

</div>

<?php	 endwhile; ?>

<?php

get_footer();
