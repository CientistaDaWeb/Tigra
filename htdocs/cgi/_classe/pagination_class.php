<?
/*
Developed by Reneesh T.K
reneeshtk@gmail.com
You can use it with out any worries...It is free for you..It will display the out put like:
First | Previous | 3 | 4 | 5 | 6 | 7| 8 | 9 | 10 | Next | Last
Page : 7  Of  10 . Total Records Found: 20
*/
class Pagination_class{
	var $result;
	var $anchors;
	var $total;
	function Pagination_class($qry,$starting,$recpage, $con)
	{
		$rst		=	$con->query($qry);
		$numrows	=	$rst->num_rows;
		$qry		 .=	" limit $starting, $recpage";
		$this->result	=	$con->query($qry);
		$next		=	$starting+$recpage;
		$var		=	((intval($numrows/$recpage))-1)*$recpage;
		$page_showing	=	intval($starting/$recpage)+1;
		$total_page	=	ceil($numrows/$recpage);

		if($numrows % $recpage != 0){
			$last = ((intval($numrows/$recpage)))*$recpage;
		}else{
			$last = ((intval($numrows/$recpage))-1)*$recpage;
		}
		$previous = $starting-$recpage;
		$anc = "<div class='dataTables_paginate'>";
		if($previous < 0){
			//$anc .= "<li class='previous-off'>Primeira</li>";
			//$anc .= "<li class='previous-off'>Anterior</li>";
		}else{
			$anc .= "<span class='paginate_button'><a href='javascript:pagination(0);'>Primeira</a></span>";
			$anc .= "<span class='paginate_button'><a href='javascript:pagination($previous);'>Anterior</a></span>";
		}
		
		################If you dont want the numbers just comment this block###############	
		$norepeat = 4;//no of pages showing in the left and right side of the current page in the anchors 
		$j = 1;
		$anch = "";
		for($i=$page_showing; $i>1; $i--){
			$fpreviousPage = $i-1;
			$page = ceil($fpreviousPage*$recpage)-$recpage;
			$anch = "<span class='paginate_button'><a href='javascript:pagination($page);'>$fpreviousPage</a></span>".$anch;
			if($j == $norepeat) break;
			$j++;
		}
		$anc .= $anch;
		$anc .= "<span class='paginate_active'>".$page_showing."</span>";
		$j = 1;
		for($i=$page_showing; $i<$total_page; $i++){
			$fnextPage = $i+1;
			$page = ceil($fnextPage*$recpage)-$recpage;
			$anc .= "<span class='paginate_button'><a href='javascript:pagination($page);'>$fnextPage</a></span>";
			if($j==$norepeat) break;
			$j++;
		}
		############################################################
		if($next >= $numrows){
			//$anc .= "<li class='previous-off'>Próxima</li>";
			//$anc .= "<li class='previous-off'>Última</li>";
		}else{
			$anc .= "<span class='paginate_button'><a href='javascript:pagination($next);'>Próxima</a></span>";
			$anc .= "<span class='paginate_button'><a href='javascript:pagination($last);'>Última</a></span>";
		}
			$anc .= "</div>";
		$this->anchors = $anc;
		
		$this->total = "Página : $page_showing <i> de  </i> $total_page . Total de itens encontrados: $numrows";
	}
}
?>