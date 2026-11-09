<?php
$array = [ 
    "Git pull & git fetch" => "The git pull command is a combination of two operations: git fetch and git merge || The git fetch command only fetches changes from the remote repository",

    "Git log" => "Displays a log of commits",

    "Clone & fork" => "Cloning creates a copy of a repository on your local machine, while forking creates a copy on a remote server",

    "git revert" => "revert a commit",

    "Rename a branch" => "git branch -m old_branch_name new_branch_name",

    "Create a branch" => "git checkout -b new_branch_name",

    "Delete a branch" => "git branch -d new_branch_name",

    "detached HEAD" => "Pointing to a specific commit instead of a branch name || git checkout commit-id",

    "Git bisect" => "helps you find the commit that introduced a bug or issue in your codebase || git bisect start ||  git bisect good <commit-hash> || git bisect bad <commit-hash>",

    "Squash multiple commits into a single commit" => "git rebase -i branch-name",

    "Git cherry-pick" => "Used to apply a specific commit from one branch to another || git cherry-pick <commit-hash>",

    "Git hooks" => "Git hooks are scripts that run automatically before or after events such as commit, push, and receive",

    "remove a file from a Git repository without deleting it from the local file" => "git rm --cached *.txt || git rm --cached -r directory_name",

    "git stash" => "Allows you to temporarily save changes in your working directory that are not yet ready to be committed || git stash save 'your stash message' || git stash apply",
    
    "git rebase" => "used to integrate changes from one branch into another. It is commonly used to update a feature branch with changes from the main branch or to clean up the commit history before merging branches || git rebase <base_branch>",

    "How do you revert a commit that has already been pushed and made public" => "git revert <commit-hash>",

    "How do you remove untracked files from the current working tree in Git" => "git clean -dfX ||  d ===> untracked directories || f ===> Force the clean operation || x ===> Remove only files ignored by Git",

    "git reset & git revert" => "revert ===> create a new commit || git reset <commit>",

    "All commands" => "git init ||
    git config --global user.name ||
    git diff ||
    git add . ||
    git rm file-name ||
    git commit -m 'message' ||
    git commit -a -m 'message' ||
    git log --oneline ||
    git show commit-id ||
    git blame ||
    git status ||
    git reset --hard commit-id ||
    git revert commit-id ||
    git remote ||
    git remote add origin url ||
    git push --set-upstream origin branch-name ||
    git merge branch-name ||
    git rebase branch-name ||
    git stash ||
    git stash apply"
 
];

 
 

include('bottom.php');

?>

<style>
.resource-box {
    background:#f8f9fa;
    padding:20px;
    border-radius:15px;
    margin:20px 0;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}
.resource-item {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 20px;
    margin-bottom:12px;
    background:white;
    border-radius:12px;
    border-left:5px solid #0d6efd;
    transition:.3s;
}
.resource-item:hover {
    transform:translateX(5px);
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}
.resource-title {
    font-size:18px;
    font-weight:700;
    color:#343a40;
}
.resource-btn {
    padding:10px 18px;
    border-radius:25px;
    text-decoration:none;
    color:white;
    font-weight:600;
    transition:.3s;
}
.chatgpt {
    background:linear-gradient(135deg,#10a37f,#087f63);
}
.youtube {
    background:linear-gradient(135deg,#ff0000,#cc0000);
}
.resource-btn:hover {
    color:white;
    transform:scale(1.05);
}
</style>
<div class="resource-box">
    <div class="resource-item">
        <span class="resource-title">🤖 ChatGPT</span>
        <a href="https://chatgpt.com/c/6a68ed39-3904-83e8-aab0-a98dce0b70e2" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=RDxQEzXN8AU" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>
 