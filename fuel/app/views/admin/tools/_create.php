<label class='control-label'>Access name ( <span class="text-muted"><?php echo Uri::base(false); ?></span><span class="text-warning">access_name</span> )</label>
<div class="input-group">
    <?php echo Form::input('name', $access->name, array('class' => 'form-control', 'placeholder'=>'Name')); ?>
    <span class="input-group-btn">
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-save"></i> Create new access rule
        </button>
    </span>
</div>