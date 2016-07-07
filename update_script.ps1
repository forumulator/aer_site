$FTP_COMP = '202.141.80.5';
$USERNAM = 'er'; $PASSWRD = 'er@791'; 
$SITE_DIR = 'newsite/try';
$add_list = @(); $rm_list = @();
$dir_list = @();

function writeFtpScript
{
    $stream = [System.IO.StreamWriter] "ftp_script.txt";
 
    # login to remote server
    $stream.WriteLine("open " + $FTP_COMP);
    $stream.WriteLine($USERNAM);
    $stream.WriteLine($PASSWRD);
    $stream.WriteLine("cd public_html/" + $SITE_DIR);
 
    if ($dir_list.length -gt 0)
        foreach ($dir in $dir_list) {
            $stream.WriteLine("mkdir " + $filw);
        }

    foreach ($filw in $rm_list) {
        $stream.WriteLine("delete " + $filw);

    }

    foreach ($filw in $add_list) {
        $stream.WriteLine("put " + $filw + " " + $filw);
    }

    $stream.WriteLine("close");
    $stream.WriteLine("quit");

    $stream.close()

}

# branches are master, content and dev

$diff_list = (git diff --name-only HEAD HEAD^).Split("`n");


# Check if the changed file was added/ changed or removed 
for ($i = 0; $i -lt $diff_list.length; $i++) {
    $curr_file = $diff_list[$i];
	if (Test-Path $curr_file) {
        $add_list += $curr_file;
    }
    else {
        $rm_list += $curr_file;
    }
}

echo "add" $add_list;
echo "rm" $rm_list;


 # Make dirs
if ($args[0] != 0)
    $dir_list = (cat mkdir_list.txt).Split("`n");

#build script
writeFtpScript;

pause;

# actual tranfer of files
ftp -i -s:ftp_script.txt;

# Delete the temorary script
rm ftp_script.txt;



