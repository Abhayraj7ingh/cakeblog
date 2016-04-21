<p><?php echo $this->Html->link('Back', array('controller' => 'Users','action' => 'index')); ?></p>
<h1><?php echo h($user['User']['username']); ?></h1>

<p><small>Created: <?php echo $user['User']['created']; ?></small></p>

<p><?php echo h($user['User']['role']); ?></p>