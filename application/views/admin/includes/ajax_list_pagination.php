<div class="row">
    <div class="col l6 m6 s6">
        Showing <?php echo ($CurrentPage - 1) * $PageSize + 1; ?> to <?php
        $last = ($CurrentPage - 1) * $PageSize + $PageSize;
		if ($last > $TotalRecords)
            echo $TotalRecords;
        else
            echo $last;
        ?> of <?php echo $TotalRecords; ?> entries
    </div>
    <div class="col l6 m6 s6">
        <ul id="custom_pagination" class="pagination right nomargin">
            <li class="waves-effect"><a class="pagination_buttons <?php
                if ($CurrentPage == 1) {
                    echo "hide";
                }
                ?>" data-page-number="<?php echo ($CurrentPage - 1); ?>" data-dt-idx="2" aria-controls="data-table-simple" ><i class="mdi-navigation-chevron-left"></i></a></li>
            <li class=" <?php
            if ($CurrentPage < 4) {
                echo "hide";
            }
            ?>">..</li>
                <?php 
                for ($i = ($CurrentPage - 2); $i <= ($CurrentPage + 2); $i++) {
                    
					if ($i > 0 && $i <= ceil($TotalRecords / $PageSize)) { 
                        ?>
                    <li class="<?php
                    if ($i == $CurrentPage) {
                        echo "active";
                    }
                    ?>">
                        <a class="pagination_buttons" href="javascript:;" data-page-number="<?php echo $i; ?>"  data-dt-idx="2" aria-controls="data-table-simple"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="<?php
            if ($CurrentPage > floor($TotalRecords / $PageSize) - 3) {
                echo "hide";
            }
            ?>">..</li>
            <li class="waves-effect <?php 
            if ($CurrentPage >= ceil($TotalRecords / $PageSize)) {
                echo $CurrentPage;
				echo "hide";
            }
            ?>"  >
                <a data-page-number="<?php echo ($CurrentPage + 1) ?>"  data-dt-idx="2" aria-controls="data-table-simple" class="pagination_buttons <?php 
            if ($CurrentPage >= ceil($TotalRecords / $PageSize)) {
                echo "hide";
            }
            ?>"><i class="mdi-navigation-chevron-right"></i></a>
            </li>
        </ul>
    </div>        
</div>        