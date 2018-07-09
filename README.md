# projectX
<p>Для запуска сайта необходимы следующие миграции (установить поочередно):
<ul>
  <li>yii migrate --migrationPath=@yii/rbac/migrations/,</li>
  <li>m180701_073143_AddUserTable.php,</li>
  <li>m180701_073144_AddAdminTable.php,</li>
  <li>m180701_074940_AddRoles.php,</li>
  <li>m180701_081700_AddAccountTable.php,</li>
  <li>m180701_082515_AddTransactionTable.php.</li> 
</ul>	
<h2>Должны быть подключены:</h2>
<ul>
  <li>(ExportMenu, gridView - kartik)http://demos.krajee.com/grid</li>
  <li>(Yii2 PHP Excel) https://www.yiiframework.com/extension/yii2-phpexcel</li>
</ul>		
<h2>Администратор (backend):</h2>
<ul>
  <li>login - admin</li>
  <li>password - 111111</li>
</ul>	
<p>
	в админку нельзя зайти через форму фронтенда, только через логин-форму на бэкэнд стороне.	
</p>
<p>
Касательно реализации: реализован весь основной функционал по ТЗ.</p>
</p>
