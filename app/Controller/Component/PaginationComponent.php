<?php
## function to create thumbnail of size 200,200 of jpeg/png 
class PaginationComponent extends Component  {
 
public function ajaxPagination($pagenumber,$total) { 
if($pagenumber!=0 and $pagenumber!=-1){$page = $pagenumber;}
else{ $page = 1; }
			
			$cur_page = $page;
			$page -= 1;
			$per_page = 40;
			$previous_btn = true;
			$next_btn = true;
			$first_btn = true;
			$last_btn = true;
			$start = $page * $per_page;
			$msg='';
			$goto ='';
			$total_string ='';
			
			
			
			$count = $total;
			$no_of_paginations = ceil($count / $per_page);
			
			
			
			if ($cur_page >= 7) {
			$start_loop = $cur_page - 3;
			if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
			} else {
			$end_loop = $no_of_paginations;
			}
			} else {
			$start_loop = 1;
			if ($no_of_paginations > 7)
			$end_loop = 7;
			else
			$end_loop = $no_of_paginations;
			}
			/* ----------------------------------------------------------------------------------------------------------- */
			$msg .= "<div class='paging'>";
			
			
			/*if ($first_btn && $cur_page > 1) {
			$msg .= "<li p='1'><a>First</a></li>";
			} else if ($first_btn) {
			$msg .= "<li p='1' class='disabled'><a>First</a></li>";
			}*/
			
			
			if ($previous_btn && $cur_page > 1) {
			$pre = $cur_page - 1;
			if($pre==1){$msg .= "<span p='$pre' class='prev'><a>Previous</a></span>"; }
			else { $msg .= "<span p='$pre' class='prev'><a>Previous</span></a>";}
			} else if ($previous_btn) {
			$msg .= "<span class='prev disabled'>Previous</span>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {
			
			
			if ($cur_page == $i) {
			if ($cur_page == 1){$msg .= "<span p='$i' class='current'>{$i}</span>";}
			else { $msg .= "<span p='$i' class='current'>{$i}</span>";}}
			else { $msg .= "<span p='$i'><a>{$i}</a></span>";}
			}
			
			
			
			if ($next_btn && $cur_page < $no_of_paginations) {
			$nex = $cur_page + 1;
			$msg .= "<span p='$nex' class='next'><a>Next</a></span>";
			} else if ($next_btn) {
			$msg .= "<span class='next disabled'>Next</span>";
			}
			
			/*
			if ($last_btn && $cur_page < $no_of_paginations) {
			$msg .= "<span p='$no_of_paginations'><a>Last</a></span>";
			} else if ($last_btn) {
			$msg .= "<span p='$no_of_paginations' class='disabled'><a>Last</a></span>";
			}*/
			
			$msg = $msg . "</div>" . $goto . $total_string; 
			echo $msg;
 
 
 
 
 }

}
?>