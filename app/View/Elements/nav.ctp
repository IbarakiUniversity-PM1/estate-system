<div id="nav">
	<h3><?php echo $this->Html->link('こうがく不動産', array('controller' => 'EstateView', 'action' => 'estateList')); ?></h3>
	<ul>
		<li>
			<div id=search1>
				<h4>検索条件指定</h4>
				<h4 class="error"></h4>
				<?php
				echo $this->Form->create(
					"Estate",
					array(
						"url"=>
							array(
								"controller"=>"EstateView",
								"action" => "estateList"
							),
						"type"=>"get"
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->input(
						"data[Estate][rent]",
						array(
							"type"=>"number",
							"label"=> "家賃",
							"required"=>true,
							"disabled"=>true,
							"min"=>1
						)
					).$this->Html->div(
						"unit",
						"円以内"
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->input(
						"data[Estate][area]",
						array(
							"type"=>"number",
							"label"=> "面積",
							"required"=>true,
							"disabled"=>true,
							"min"=>1
						)
					).$this->Html->div(
						"unit",
						"畳以上"
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->input(
						"data[Estate][age]",
						array(
							"type"=>"number",
							"label"=> "築年数",
							"required"=>true,
							"disabled"=>true,
							"min"=>0
						)
					).$this->Html->div(
						"unit",
						"年以内"
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->input(
						"data[Estate][window_direction]",
						array(
							"type"=>"select",
							"options"=>$estateWindowList,
							"label"=> "窓の向き",
							"required"=>true,
							"disabled"=>true
						)
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->hidden(
						"data[Estate][deposit]",
						array(
							"value"=>0,
							"disabled"=>true
						)
					).$this->Html->div(
						"",
						"敷金なし"
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->hidden(
						"data[Estate][key_money]",
						array(
							"value"=>0,
							"disabled"=>true
						)
					).$this->Html->div(
						"",
						"礼金なし"
					)
				);
				echo $this->Html->div(
					"condition",
					$this->Form->input(
						"",
						array(
							"type"=>"checkbox",
							"div"=>"check",
							"label"=>false
						)
					).$this->Form->hidden(
						"data[Estate][common_service_pay]",
						array(
							"value"=>0,
							"disabled"=>true
						)
					).$this->Html->div(
						"",
						"共益費なし"
					)
				);
				foreach($estateCharacteristicList as $k=>$v){
					echo $this->Html->div(
						"condition",
						$this->Form->input(
							"",
							array(
								"type"=>"checkbox",
								"div"=>"check",
								"label"=>false
							)
						).$this->Form->hidden(
							"data[EstateCharacteristicReference][estate_characteristic_id][]",
							array(
								"value"=>$k,
								"disabled"=>true
							)
						).$this->Html->div(
							"",
							$v
						)
					);
				}
				echo $this->Html->div(
					"buttons",
					$this->Form->submit("検索")
				);
				echo $this->Form->end();
				?>
			</div>
		</li>
		<li>
			<div id=search2>
				<h4>キーワード検索</h4>
				<?php
				echo $this->Form->create(
					"Estate",
					array(
						"url"=>
							array(
								"controller"=>"EstateView",
								"action" => "estateList"
							),
						"type"=>"get"
					)
				);
				echo $this->Form->input(
					"estate_keyword_type",
					array(
						"type"=>"select",
						"options"=>$estateKeywordTypeList,
						"label"=>false,
						"div"=>false
					)
				);
				echo $this->Form->input(
					"",
					array(
						"type"=>"text",
						"div"=>false,
						"required"=>true
					)
				);
				echo $this->Html->div(
					"buttons",
					$this->Form->submit("検索")
				);
				echo $this->Form->end();
				?>
			</div>
		</li>
		<li>
			<div id="agent_list">
				<table>
					<thead>
					<?php echo $this->Html->tableHeaders(array("提供不動産業者")) . PHP_EOL ?>
					</thead>
					<tbody>
					<?php foreach ($estateAgent as $e) {
						$e = $e["EstateAgent"];
						echo "        " . $this->Html->tableCells(array($e["name"] . "<br>TEL : " . $e["phone_number"])) . PHP_EOL;
					} ?>
					</tbody>
				</table>
			</div>
		</li>
	</ul>
</div>
