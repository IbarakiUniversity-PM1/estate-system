#環境構築手順
1. `git update-index --skip-worktree .htaccess`コマンドを実行し、`.htaccess`をGitの管理下から除外します。
1. `git update-index --skip-worktree app/webroot/.htaccess`コマンドを実行し、`app/webroot/.htaccess`をGitの管理下から除外します。
1. `.htaccess`と`app/webroot/.htaccess`のTODO部をコメントに従って書き換えます。
2. [CakePHP 2.7の導入方法 - Qiita](http://qiita.com/SUZUKI_Masaya/items/0dfb8426a4c6b9e84712)に従って、デプロイメントと実行環境の設定を行います。
