git fetch origin master;
git merge --ff-only;

if ($LASTEXITCODE != 0) {
    Invoke-Expression "update_content.ps1"
    echo "Error downloading updates because of conflicts. I'll try to resolve conflicts and you can try again in some time";
}
else {
    Invoke-Expression "update_script.ps1 1"
}

