<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>

    <title><?php echo $this->fetch('title'); ?> - こうがく不動産</title>
    <?php
    echo "        " . $this->Html->meta('icon') . PHP_EOL;

    echo "        " . $this->Html->css('cake.generic') . PHP_EOL;

    echo "        " . $this->fetch('meta') . PHP_EOL;
    echo "        " . $this->Html->css('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css') . PHP_EOL;
    echo "        " . $this->fetch('css') . PHP_EOL;
    //Viewに『$this->assign("nav", true)』を埋め込むことで、検索条件指定・提供不動産業者を表示できる
    if ($this->fetch('nav')) {
        echo "        " . $this->Html->css("elements/nav") . PHP_EOL;
    }
    echo "        " . $this->Html->css("header") . PHP_EOL;

    echo "        " . $this->Html->script('//code.jquery.com/jquery-1.11.3.min.js') . PHP_EOL;
    echo "        " . $this->Html->script('//code.jquery.com/ui/1.11.4/jquery-ui.min.js') . PHP_EOL;
    echo "        " . $this->Html->script('cake.generic') . PHP_EOL;
    echo "        " . $this->fetch('script') . PHP_EOL;
    ?>
</head>
<body>
	<div id="header">
		<div id="header_contents">
			<?php
			echo $this->Html->nestedList(array($this->element('breadcrumbs')),array("class"=>"site_header"));
			echo str_replace(PHP_EOL, PHP_EOL . "        ", rtrim(
					$this->requestAction(
						array(
							'controller'=>'Header',
							'action'=>'head'
						)
					)
				)) . PHP_EOL;
			?>
		</div>
	</div>
    <div id="container">
    <div id="content">
        <?php echo $this->Flash->render() . PHP_EOL; ?>
        <?php
        //Viewに『$this->assign("nav", true)』を埋め込むことで、検索条件指定・提供不動産業者を表示できる
        if ($this->fetch('nav')) {
            echo str_replace(PHP_EOL, PHP_EOL . "        ", rtrim(
					$this->requestAction(
						array(
							'controller'=>'Navigation',
							'action'=>'nav'
						)
					)
				)) . PHP_EOL;
        }
        ?>
        <div id="main">
            <h2><?php echo $this->fetch('title'); ?></h2>
            <?php echo str_replace(PHP_EOL, PHP_EOL . "            ", rtrim($this->fetch('content'))) . PHP_EOL; ?>
        </div>
    </div>
    <div id="footer">
        <?php echo $this->Html->link(
            $this->Html->image(
                'cake.power.gif',
                array(
                    'alt' => $cakeDescription,
                    'border' => '0'
                )
            ),
            'http://www.cakephp.org/',
            array(
                'target' => '_blank',
                'escape' => false,
                'id' => 'cake-powered'
            )
        ); ?>
        <p><?php echo $cakeVersion; ?></p>
    </div>
        <p id="page-top"><a href="#container">PAGE TOP</a></p>
    </div>
</body>
</html>
