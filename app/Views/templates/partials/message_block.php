<?php if (session()->has('success')) : ?>
	<div class="alert alert-success">
            <span class="text text-white"><?= session('success') ?></span>
	</div>
<?php endif; ?>

<?php if (session()->has('info')) : ?>
	<div class="alert alert-info">
            <span class="text text-white"><?= session('info') ?></span>
	</div>
<?php endif; ?>

<?php if (session()->has('error')) : ?>
	<div class="alert alert-danger">
            <span class="text text-white"><?= session('error') ?></span>
	</div>
<?php endif; ?>

<?php if (session()->has('errors')) : ?>
	<ul style="list-style: none;" class="alert alert-danger">
	<?php foreach (session('errors') as $error) : ?>
            <span class="text-white"><li><?= $error ?></li></span>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
