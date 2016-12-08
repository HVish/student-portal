<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- page start-->
		<div class="row">
			<div class="col-md-12">
                <h3>Marksheet</h3>
                <section class="panel">
                    <header class="panel-heading no-border">
                        RTU marksheet for <?php echo $semester;
                        if ($semester == 1) {
                            echo '<sup>st</sup>';
                        } elseif ($semester == 2) {
                            echo '<sup>nd</sup>';
                        } elseif ($semester == 3) {
                            echo '<sup>rd</sup>';
                        } else {
                            echo '<sup>th</sup>';
                        }
                        ?> semester
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Internal</th>
                                <th>External</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <?php foreach ($tabledata as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['code']; ?></td>
                                        <td><?php echo $value['Internal']['marks'].'/'.$value['Internal']['maxMarks']; ?></td>
                                        <td><?php echo $value['External']['marks'].'/'.$value['External']['maxMarks']; ?></td>
                                        <td><?php echo($value['Internal']['marks'] + $value['External']['marks']).'/'.($value['Internal']['maxMarks'] + $value['External']['maxMarks']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (count($tabledata) == 0) {
                            ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center"> No data in the table!</td>
                                    </tr>
                                    <?php
                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
			</div>
		</div>
		<!-- page end-->
	</section>
</section>
<!--main content end-->
