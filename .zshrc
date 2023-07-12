ZSH_THEME="powerlevel9k/powerlevel9k"POWERLEVEL9K_DISABLE_RPROMPT=true
POWERLEVEL9K_PROMPT_ON_NEWLINE=true
POWERLEVEL9K_MULTILINE_LAST_PROMPT_PREFIX="▶"
POWERLEVEL9K_MULTILINE_FIRST_PROMPT_PREFIX=""

# >>> conda initialize >>>
# !! Contents within this block are managed by ‘conda init’ !!
__conda_setup=”$(‘/home/yourusername/anaconda3/bin/conda’ ‘shell.bash’ ‘hook’ 2> /dev/null)”
if [ $? -eq 0 ]; then
 eval “$__conda_setup”
else
 if [ -f “/home/seid/anaconda3/etc/profile.d/conda.sh” ]; then
 . “/home/seid/anaconda3/etc/profile.d/conda.sh”
 else
 export PATH=”/home/seid/anaconda3/bin:$PATH”
 fi
fi
unset __conda_setup
# <<< conda initialize <<<
