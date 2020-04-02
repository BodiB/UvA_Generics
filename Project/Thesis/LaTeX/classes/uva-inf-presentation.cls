%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
% LATEX PAV PACKAGE
% Voor readme en meest recente versie, zie
% https://gitlab-fnwi.uva.nl/informatica/LaTeX-template.git
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

%-------------------------------------------------------------------------------
%	PACKAGES
%-------------------------------------------------------------------------------

\NeedsTeXFormat{LaTeX2e}
\ProvidesClass{uva-inf-presentation}
\LoadClass{beamer}

\RequirePackage{translations}
\RequirePackage{lipsum}
\RequirePackage[utf8]{inputenc}
\RequirePackage{booktabs}
\RequirePackage[dutch]{babel}
\RequirePackage{graphicx}
\RequirePackage{tikz}

%-------------------------------------------------------------------------------
%	INSTELLINGEN
%-------------------------------------------------------------------------------

\DeclareOption*{\PassOptionsToClass{\CurrentOption}{article}}
\ProcessOptions

%-------------------------------------------------------------------------------
%	VERTALINGEN
%-------------------------------------------------------------------------------

\deftranslation[to=Dutch]{Theorem}{Stelling}
\deftranslation[to=Dutch]{Example}{Voorbeeld}

%-------------------------------------------------------------------------------
%	STIJL
%-------------------------------------------------------------------------------

\mode<presentation> {
\usetheme{default}
\usecolortheme{seagull}
\setbeamertemplate{footline}[text line]{%
  \parbox{\linewidth}{\insertshorttitle\hfill\insertshortauthor
  \hfill{\insertpagenumber} van \insertpresentationendpage}}
}

\addtobeamertemplate{frametitle}{}{%
\begin{tikzpicture}[remember picture,overlay]
\node[anchor=north east,yshift=-2.5pt] at (current page.north east)
  {\includegraphics[width=6.6cm]{logoUvA_nl}};
\end{tikzpicture}}
