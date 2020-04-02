\NeedsTeXFormat{LaTeX2e}
\ProvidesClass{uva-bachelor-thesis}[2005/06/10 Version 0.1 Rein van den Boomgaard]

\RequirePackage{graphicx}
\RequirePackage[a4paper,scale={0.7,0.8},twoside]{geometry}
\RequirePackage[svgnames]{xcolor}
\RequirePackage[absolute]{textpos}
\RequirePackage{rotating}

\def\supervisors#1{\gdef\@supervisors{#1}}
\def\signedby#1{\gdef\@signedby{#1}}

\DeclareOption*{\PassOptionsToClass{\CurrentOption}{report}}
\ProcessOptions\relax
\LoadClass[10pt,twoside]{report}

\renewcommand{\maketitle}{%
	\thispagestyle{empty}
	% A fake element on the page (else texpos absolute option doesn't work)
    \hspace*{1em}

	\begin{textblock*}{10cm}(6cm,3cm)
		\noindent\large\scshape Bachelor Informatica\\[2ex]
		\includegraphics[height=1cm]{logoUvA_nl_xl}
		%\Large Universiteit van Amsterdam
	\end{textblock*}

	\begin{textblock*}{10cm}(6cm,12cm)
		\noindent
		\sffamily\Huge \@title
	\end{textblock*}

	\begin{textblock*}{10cm}(6cm,18cm)
		\noindent
		\sffamily\Large \@author\\[3pc]
		\@date
	\end{textblock*}

	\begin{textblock*}{10cm}(6cm,26cm)
		\noindent\sffamily
		\begin{description}
		\item[\sffamily Supervisor(s):] \@supervisors
		\item[\sffamily Signed:] \@signedby
		\end{description}
	\end{textblock*}

	\textblockcolor{LightGray}
	\begin{textblock*}{2cm}(3cm,2cm)
		\vspace*{26cm}\hspace*{1em}
	\end{textblock*}

	\begin{textblock*}{2cm}(3.7cm,25cm)
		\begin{rotate}{90}
			\noindent\scshape\Huge\textcolor{DarkGray}{
				Informatica --- Universiteit van Amsterdam}
		\end{rotate}
	\end{textblock*}

	\cleardoublepage
}
