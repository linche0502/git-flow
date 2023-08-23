ROBOCOPY "D:\OneDrive\Documents\workspace\php\php_test" "C:\Program Files\AppServ\www\test" /MIR /MON:1


::/MIR  鏡像樹狀目錄 (相當於 /E 加 /PURGE)
::/MON:n  監視來源; 看到 n 個字元以上時再次執行
::/MOT:m  監視來源; m 分鐘後如果變更，則再次執行