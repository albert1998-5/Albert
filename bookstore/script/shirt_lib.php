<?php 
function buildNavigation( $pageNum_Recordset1, $totalPages_Recordset1, $prev_Recordset1, $next_Recordset1, $separator = " | ", $max_links = 10, $show_page = true, $selmode = 1, $sname ) {
	$gmaxRows = "maxRows_" . $sname;
	$gtotalRows = "totalRows_" . $sname;

	GLOBAL $$gmaxRows, $$gtotalRows;
	$pagesArray = "";
	$firstArray = "";
	$lastArray = "";
	if ( $max_links < 2 )$max_links = 2;
	if ( $pageNum_Recordset1 <= $totalPages_Recordset1 && $pageNum_Recordset1 >= 0 ) {
		if ( $pageNum_Recordset1 > ceil( $max_links / 2 ) ) {
			$fgp = $pageNum_Recordset1 - ceil( $max_links / 2 ) > 0 ? $pageNum_Recordset1 - ceil( $max_links / 2 ) : 1;
			$egp = $pageNum_Recordset1 + ceil( $max_links / 2 );
			if ( $egp >= $totalPages_Recordset1 ) {
				$egp = $totalPages_Recordset1 + 1;
				$fgp = $totalPages_Recordset1 - ( $max_links - 1 ) > 0 ? $totalPages_Recordset1 - ( $max_links - 1 ) : 1;
			}
		} else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1 + 1;
		}
		if ( $totalPages_Recordset1 >= 1 ) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';
			if ( !empty( $_GET ) || !empty( $HTTP_GET_VARS ) ) {
				$_GET = empty( $_GET ) ? $HTTP_GET_VARS : $_GET;
				foreach ( $_GET as $_get_name => $_get_value ) {
					if ( $_get_name != "pageNum_" . $sname ) {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1 + 1;
			$precedente = $pageNum_Recordset1 - 1;

			switch ( $selmode ) {
				case 1:
					$firstArray = ( $pageNum_Recordset1 > 0 ) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$precedente$_get_vars\">$prev_Recordset1</a>": "$prev_Recordset1";
					break;
				case 2:
					$firstArray = ( $pageNum_Recordset1 > 0 ) ? "<li><a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$precedente$_get_vars\" aria-label='Previous'><span aria-hidden='true'>$prev_Recordset1</span></a>": "<li class='disabled'><span aria-hidden='true'>$prev_Recordset1</span></li>";
					break;
				case 3:
					$firstArray = ( $pageNum_Recordset1 > 0 ) ? "<a href='javascript:void(0);' onclick='searchHistory(".$precedente.")'>".$prev_Recordset1."</a>": "<span>$prev_Recordset1</span>";
					break;
                case 4:
                    $firstArray = ( $pageNum_Recordset1 > 0 ) ? "<a href='javascript:void(0);' onclick='searchHistory(".$precedente.",2)'>".$prev_Recordset1."</a>": "<span>$prev_Recordset1</span>";
                    break;
                case 5:
                    $firstArray = ( $pageNum_Recordset1 > 0 ) ? "<a href='javascript:void(0);' onclick='searchHistory(".$precedente.",1)'>".$prev_Recordset1."</a>": "<span>$prev_Recordset1</span>";
                    break;
                case 6:
                    $firstArray = ( $pageNum_Recordset1 > 0 ) ? "<li class='paginate_button previous'><a href='javascript:void(0);' onclick='searchHistory(".$precedente.")'>".$prev_Recordset1."</a></li>": "<li class='paginate_button previous disabled'><span>$prev_Recordset1</span></li>";
                    break;
                    //  <li class="paginate_button previous"><a href="#">Previous</a></li>

            }
			# ----------------------
			# page numbers
			# ----------------------
			for ( $a = $fgp + 1; $a <= $egp; $a++ ) {
				$theNext = $a - 1;
				if ( $show_page ) {
					$textLink = $a;
				} else {
					// $min_l = (($a-1)*$maxRows_Recordset1) + 1;
					// $max_l = ($a*$maxRows_Recordset1 >= $totalRows_Recordset1) ? $totalRows_Recordset1 : ($a*$maxRows_Recordset1);
					$min_l = ( ( $a - 1 ) * $$gmaxRows ) + 1;
					$max_l = ( $a * $$gmaxRows >= $$gtotalRows ) ? $$gtotalRows : ( $a * $$gmaxRows );
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor( $theNext / 26 );
				if ( $theNext != $pageNum_Recordset1 ) {
					switch ( $selmode ) {
						case 1:
							$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$theNext$_get_vars\">";
							$pagesArray .= "$textLink</a>" . ( $theNext < $egp - 1 ? $separator : "" );
							break;
						case 2:
							$pagesArray .= "<li><a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$theNext$_get_vars\">";
							$pagesArray .= "$textLink</a><li>";
							break;
						case 3:
							// $pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$theNext$_get_vars\">";
							$pagesArray .= "<a href='javascript:void(0);' onclick='searchHistory(".($textLink-1).")'>".$textLink."</a>" ;
							break;
                        case 4:
                            // $pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$theNext$_get_vars\">";
                            $pagesArray .= "<a href='javascript:void(0);' onclick='searchHistory(".($textLink-1).",2)'>".$textLink."</a>" ;
                            break;
                        case 5:
                            // $pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$theNext$_get_vars\">";
                            $pagesArray .= "<a href='javascript:void(0);' onclick='searchHistory(".($textLink-1).",1)'>".$textLink."</a>" ;
                            break;
                        case 6:
                            // $pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$theNext$_get_vars\">";
                            $pagesArray .= " <li class='paginate_button'><a href='javascript:void(0);' onclick='searchHistory(".($textLink-1).")'>".$textLink."</a></li>" ;
                            break;


                    }
				} else {
					switch ( $selmode ) {
						case 1:
							$pagesArray .= "$textLink" . ( $theNext < $egp - 1 ? $separator : "" );
							break;
						case 2:
							$pagesArray .= "<li class='active'>$textLink</li>";
							break;
						case 3:
							$pagesArray .= "<span class='current'>$textLink</span>" ;
							break;
                        case 4:
                            $pagesArray .= "<span class='current'>$textLink</span>" ;
                            break;
                        case 5:
                            $pagesArray .= "<span class='current'>$textLink</span>" ;
                            break;
                        case 6:
                            $pagesArray .= " <li class='paginate_button active'><span>$textLink</span></li>" ;
                            break;


                    }
				}
			}
			$theNext = $pageNum_Recordset1 + 1;
			$offset_end = $totalPages_Recordset1;
			switch ( $selmode ) {
				case 1:
					$lastArray = ( $pageNum_Recordset1 < $totalPages_Recordset1 ) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$successivo$_get_vars\">$next_Recordset1</a>": "$next_Recordset1";
					break;
				case 2:
					// <li><a href="#" aria-label="Next"><span aria-hidden='true'>&raquo;</span></a></li>
					$lastArray = ( $pageNum_Recordset1 < $totalPages_Recordset1 ) ? "<li><a href=\"$_SERVER[PHP_SELF]?pageNum_" . $sname . "=$successivo$_get_vars\" aria-label='Next'><span aria-hidden='true'>$next_Recordset1</span></a>": "<li class='disabled'><span aria-hidden='true'>$next_Recordset1</span></li>";
					break;
				case 3:
					$lastArray = ( $pageNum_Recordset1 < $totalPages_Recordset1 ) ? "<a href='javascript:void(0);' onclick='searchHistory(".$theNext.")'>".$next_Recordset1."</a>": "<span>$next_Recordset1</span>";
					break;
                case 4:
                    $lastArray = ( $pageNum_Recordset1 < $totalPages_Recordset1 ) ? "<a href='javascript:void(0);' onclick='searchHistory(".$theNext.",2)'>".$next_Recordset1."</a>": "<span>$next_Recordset1</span>";
                    break;
                case 5:
                    $lastArray = ( $pageNum_Recordset1 < $totalPages_Recordset1 ) ? "<a href='javascript:void(0);' onclick='searchHistory(".$theNext.",1)'>".$next_Recordset1."</a>": "<span>$next_Recordset1</span>";
                    break;
                case 6:
                    $lastArray = ( $pageNum_Recordset1 < $totalPages_Recordset1 ) ? "<li class='paginate_button next'><a href='javascript:void(0);' onclick='searchHistory(".$theNext.")'>".$next_Recordset1."</a></li>": "<li class='paginate_button next'><span>$next_Recordset1</span></li>";
                    break;

            }
		}
	}
	return array( $firstArray, $pagesArray, $lastArray );
}

?>