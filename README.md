#環境構築手順
1. `git update-index --skip-worktree .idea`コマンドを実行し、`.idea`ディレクトリをGitの管理下から除外します。
1. `git update-index --skip-worktree nbproject`コマンドを実行し、`nbproject`ディレクトリをGitの管理下から除外します。
1. `git update-index --skip-worktree .project`コマンドを実行し、`.project`をGitの管理下から除外します。
1. `git update-index --skip-worktree .classpath`コマンドを実行し、`.classpath`をGitの管理下から除外します。
1. `git update-index --skip-worktree estate-system.eml`コマンドを実行し、`estate-system.eml`をGitの管理下から除外します。
1. `git update-index --skip-worktree app/tmp`コマンドを実行し、`app/tmp`ディレクトリをGitの管理下から除外します。
1. `git update-index --skip-worktree .htaccess`コマンドを実行し、`.htaccess`をGitの管理下から除外します。
1. `git update-index --skip-worktree app/webroot/.htaccess`コマンドを実行し、`app/webroot/.htaccess`をGitの管理下から除外します。
1. `.htaccess`と`app/webroot/.htaccess`のTODO部をコメントに従って書き換えます。
2. [CakePHP 2.7の導入方法 - Qiita](http://qiita.com/SUZUKI_Masaya/items/0dfb8426a4c6b9e84712#%E3%83%87%E3%83%97%E3%83%AD%E3%82%A4%E3%83%A1%E3%83%B3%E3%83%88%E3%81%AE%E8%A8%AD%E5%AE%9A)に従って、デプロイメントと実行環境の設定を行います。
