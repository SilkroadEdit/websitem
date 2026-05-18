<?php
class Pagenation {
	 /* Pagination*/
	 Public function Pagination ($Page  ,$Total)
	 {
		/** Show pagination if there is more than one page **/
		If ($Total > 1){
		
		If ($Page == 1 ){$StatusF = "disabled";}
		If ($Page == $Total ){$StatusL = "disabled";}
		$Prev = ($Page - 1);
		$Next = ($Page + 1);
for($i=($Page-2); $i<=($Page+2); $i++)	{
				if($i<1) continue;
				if($i>$Total) break;
				if($Page == $i)
		  $x++;
			if($Page == $x) { 
			 $active ="active";
			 }else{
		     $active = "";
			 }		
		}
		If ($Page == 1 ) {
				/** First page **/
	echo'<li class="paginate_button page-item disabled"><a class="page-link">&laquo;</a></li>';
		}else{
		
		echo'<li class="paginate_button page-item "><a class="page-link" onclick="switchPage(1);">&laquo;</a></li>';
		
		}
	
		if(($Page-3)>0) {
				if($_GET["pagekarakter"] == 1)
					echo '<li class="paginate_button page-item "><a class="page-link" onclick="switchPage('.$x.');">'.$x.'</a></li>';
				else				
					echo '<li class="paginate_button page-item "><a class="page-link" onclick="switchPage('.$x.');">'.$x.'</a></li>';
			}
		
		if(($Page-3)>0) {
			
			}
		
		for($i=($Page-2); $i<=($Page+2); $i++)	{
				if($i<1) continue;
				if($i>$Total) break;
			if($Page == $i) { 
			 $active ="active";
			 }else{
		     $active = "";
			 }
				if($Page == $i)
					echo '<li class="paginate_button page-item '.$active.'"><a class="page-link" onclick="switchPage('.$i.');">'.$i.'</a></li>';
				else				
					echo '<li class="paginate_button page-item '.$active.'"><a class="page-link" onclick="switchPage('.$i.');">'.$i.'</a></li>';
			}
		
		
		if(($Total-($Page+2))>1) {
			echo '</li><li class="disabled"><span>...</span></li>';
				echo '<li class="paginate_button page-item "><a class="page-link" onclick="switchPage('.$Total.');">'.$Total.'</a></li>';
			}
	If ($Page == $Total ) {	

echo'<li class="paginate_button page-item disabled"><a class="page-link">&raquo;</a></li>';
	}else{
echo'<li class="paginate_button page-item "><a class="page-link" onclick="switchPage('.$Next.');">&raquo;</a></li>';	
	}
		}
	}
	
	/* Pagination*/
	 Public function PaginationAjax ($Page , $Url ,$Total ,$Div ,$FuncName)
	 {
		echo'
		<script>
		function '.$FuncName.'(url){
			$("#'.$Div.'").html(" <h3><center>Loading please wait...</center></h3><br><span class=\'nk-preloader-animation\'></span>");
			$("#'.$Div.'").load("'.$Url.'"+url);
			}
		</script>';
		/** Show pagination if there is more than one page **/
		If ($Total > 1){
		
		If ($Page == 1 ){$StatusF = "disabled";}
		If ($Page == $Total ){$StatusL = "disabled";}
		$Prev = ($Page - 1);
		$Next = ($Page + 1);
		
		
	    echo'<div class="nk-pagination nk-pagination-left">';
		
		/** First page **/
		echo'<a onclick="'.$FuncName.'(1)" style ="color:olive" class="nk-pagination-prev '.$StatusF.'">
                <span class="nk-icon-arrow-left"></span>
             </a>';
	    /** Prev Page **/
		echo'<a onclick="'.$FuncName.'('.$Prev.')" class="nk-pagination-prev '.$StatusF.'">
                <span class="nk-icon-arrow-left"></span>
             </a>';
		echo'<nav>';
		
		if(($Page-3)>0) {
				if($_GET["page"] == 1)
					echo'<a style="cursor: pointer;" class="nk-pagination-current-white" onclick="'.$FuncName.'(1)">1</a>';
				else				
					echo'<a style="cursor: pointer;" onclick="'.$FuncName.'(1)">1</a>';
			}
		
		if(($Page-3)>1) {
					echo '...';
			}
		
		for($i=($Page-2); $i<=($Page+2); $i++)	{
				if($i<1) continue;
				if($i>$Total) break;
				if($Page == $i)
					echo'<a  style="cursor: pointer;" class="nk-pagination-current-white" onclick="'.$FuncName.'('.$i.')">'.$i.'</a>';
				else				
					echo'<a  style="cursor: pointer;" onclick="'.$FuncName.'('.$i.')">'.$i.'</a>';
			}
		
		
		if(($Total-($Page+2))>1) {
				echo '<li ><a onclick="switchPage('.$Total.');">'.$Total.'</a></li>';
			}
		

		}
	}

}
?>