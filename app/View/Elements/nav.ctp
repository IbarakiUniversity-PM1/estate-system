<div id="nav">
    <h3><a href="/estate-system">こうがく不動産</a></h3>

    <ul>

        <li>
            <div id=search1>
                <form action="/estate-system/" method="get">
                    <p><input type="hidden" name="isSearch" value="true"</p>
                    <p><input type="checkbox" name="rent" value="true"> 家賃
                        <select name="rent_num">
                            <option value="10000">10000</option>
                            <option value="15000">15000</option>
                            <option value="20000">20000</option>
                            <option value="25000">25000</option>
                            <option value="30000">30000</option>
                            <option value="35000">35000</option>
                            <option value="40000">40000</option>
                            <option value="45000">45000</option>
                            <option value="50000">50000</option>
                            <option value="55000">55000</option>
                            <option value="60000">60000</option>
                            <option value="65000">65000</option>
                            <option value="70000">70000</option>
                            <option value="75000">75000</option>
                            <option value="80000">80000</option>
                            <option value="85000">85000</option>
                            <option value="90000">90000</option>
                            <option value="95000">95000</option>
                            <option value="100000">100000</option>
                        </select>
                        円以内
                    </p>
                    <p><input type="checkbox" name="area" value="true"> 面積:
                        <select name="area_num">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select> m&sup2;以上
                    </p>
                    <p><input type="checkbox" name="age" value="true"> 築年数:
                        <select name="age_num">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select> 年以内
                    </p>
                    <p><input type="checkbox" name="common_service_pay" value="true">共益費:なし</p>
                    <p><input type="checkbox" name="key_money" value="true">礼金:なし</p>
                    <p><input type="checkbox" name="deposit" value="0">敷金:なし</p>
                    <p><input type="checkbox" name="chara[]" value="bath_toilet">バストイレ:別</p>
                    <p><input type="checkbox" name="chara[]" value="gas_stove">ガスキッチン:あり</p>
                    <p><input type="checkbox" name="chara[]" value="woman_only">女性限定</p>
                    <p><input type="checkbox" name="chara[]" value="student_only"> 学生限定</p>
                    <p><input type="checkbox" name="chara[]" value="room_share">ルームシェア:可能</p>
                    <p><input type="checkbox" name="chara[]" value="laundry_area">洗濯機置き場:室内</p>
                    <p><input type="checkbox" name="chara[]" value="air_conditioner"> エアコン:あり</p>
                    <p><input type="checkbox" name="chara[]" value="elevator">エレベータ:あり</p>
                    <p><input type="checkbox" name="chara[]" value="auto_lock">オートロック:あり</p>
                    <p><input type="checkbox" name="chara[]" value="interphone">インターホン:あり</p>
                    <p><input type="checkbox" name="chara[]" value="pet_breeding">ペット飼育:可能</p>
                    <p><input type="checkbox" name="chara[]" value="playing_an_instrument">楽器演奏:可能</p>
                    <p><input type="checkbox" name="window_direction" value="true">窓の向き:南</p>

                    <p><input type="submit" name="button" value="検索" /></p>
                </form>



            </div>


        </li>


        <li>
            <div id="agent_list">
                <table>
                    <thead>
                        <?php echo $this->Html->tableHeaders(array("提供不動産業者")) . PHP_EOL ?>
                    </thead>
                    <tbody>
                        <?php foreach ($estate_agents as $e) {
    $e = $e["EstateAgent"];
    echo "        " . $this->Html->tableCells(array($e["name"] . "<br>TEL : " . $e["phone_number"])) . PHP_EOL;
} ?>
                    </tbody>
                </table>

            </div>

        </li>
    </ul>


</div>
