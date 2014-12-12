set nocompatible

let mapleader = " "

set showmatch
set showcmd

set autoindent
set smartindent
set tabstop=4
set shiftwidth=4

set incsearch
set ruler

set bg=dark
syntax on
set hlsearch

set nowrap

set number
set numberwidth=5

set mouse=a

augroup vimrcEx
	autocmd!
	filetype on
	" For all text files set 'textwidth' to 78 characters.
	autocmd FileType text setlocal textwidth=78
	
	" When editing a file, always jump to the last known cursor position.
	" Don't do it for commit messages, when the position is invalid, or when
	" inside an event handler (happens when dropping a file on gvim).
	autocmd BufReadPost *
	\ if &ft != 'gitcommit' && line("'\"") > 0 && line("'\"") <= line("$") |
	\   exe "normal g`\"" |
	\ endif
	
	autocmd BufRead,BufNewFile *.json set filetype=json syntax=javascript
	autocmd BufRead,BufNewFile *.md set filetype=markdown
	autocmd FileType markdown setlocal spell
	autocmd Filetype markdown setlocal wrap
	autocmd Filetype markdown setlocal linebreak
	autocmd Filetype markdown setlocal nolist
	autocmd Filetype markdown setlocal columns=80
	
	" Automatically wrap at 80 characters for Markdown
	" autocmd BufRead,BufNewFile *.md setlocal textwidth=80
augroup END

