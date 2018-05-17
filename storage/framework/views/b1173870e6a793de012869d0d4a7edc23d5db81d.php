

<?php $__env->startSection('title'); ?>
	Search User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container main-container">
	<!-- Panel start -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Search</h2>
		</div>
		<!-- Panel body start -->
		<div class="panel-body">
			<!-- Search form start -->
			<form id="search-form" class="form-horizontal" action="<?php echo e(route('search')); ?>" method='POST'>
				<?php echo csrf_field(); ?>

				<input type="hidden" id="current_page" name="current_page" value="<?php echo e($current_page); ?>">
				<input type="hidden" name="old_search_term" value="<?php echo e(old('search_term')); ?>">
				<div class="form-group">
					<label class="control-label col-sm-4" for="search_term">Search Text<span class="red">*</span></label>
					<div class="col-sm-4 mb-10">
						<input type="text" class="form-control" name="search_term" class="search_term" placeholder="Search with name" value="<?php echo e(old('search_term')); ?>" required>
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</div>
			</form>
			<!-- Search form end -->
			
			<?php if(isset($users)): ?>
				<hr>
				<!-- User list start -->
				<?php if(empty($users)): ?>
					<div class="row">
						<div class="col-md-offset-1 col-md-10 text-center">
							No Result Found.
						</div>
					</div>
				<?php else: ?>
					<div class="row">
						<div class="col-md-12 tabel-heading hidden-xs hidden-sm">
							<div class="col-md-2">User Id</div>
							<div class="col-md-2">Image</div>
							<div class="col-md-2">Name</div>
							<div class="col-md-2">Score</div>
							<div class="col-md-2">Profile and Follower</div>
							<div class="col-md-2">Profile on Git</div>
						</div>
					</div>
					<?php foreach($users as $user): ?>
					<div class="row"><div class="col-md-12"><hr></div></div>
					
					<div class="row">
						<div class="col-md-12 tabel-body">
							<div class="col-md-2"><?php echo e($user['id']); ?></div>
							<div class="col-md-2"><img class="img-circle srch-img" title="<?php echo e($user['login']); ?>" width="80px;" height="80px;" src="<?php echo e($user['avatar_url']); ?>"></div>
							<div class="col-md-2"><?php echo e($user['login']); ?></div>
							<div class="col-md-2"><?php echo e($user['score']); ?></div>
							<div class="col-md-2"><a target="_blank" href="profile?profile_url=<?php echo e($user['url']); ?>">Profile and Follower</a></div>
							<div class="col-md-2"><a target="_blank" href="<?php echo e($user['html_url']); ?>">Profile on Git</a></div>
						</div>
					</div>
					<?php endforeach; ?>
					<!-- User list end -->

					<div class="row">
						<div class="col-md-12 text-right">
							<ul class="pagination">
								<?php if($current_page > 1): ?>
									<li><a href="javascript:void();" id="previous">Previous</a></li>
								<?php endif; ?>
								<?php if($current_page < $total_page && $total_page > 1 && $current_page < 34): ?>
									<li><a class="btn" href="javascript:void();" id="next">Next</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>

				<?php endif; ?>
			<?php endif; ?>

		</div>
		<!-- Panel body end -->
	</div>
	<!-- Panel end -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
			/* Next page processing */
			$("#next").click(function(){
					var page = parseInt($('#current_page').val()) + 1;
					$('#current_page').val(page);
					$('#search-form').submit();	
			});

			/* Previous page processing */
			$("#previous").click(function(){
					var page = parseInt($('#current_page').val()) - 1;
					$('#current_page').val(page);
					if(page){
						$('#search-form').submit();
					}
			});

		});	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>