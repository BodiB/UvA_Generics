import random
import pygame
import sys
import math
from pygame.locals import *

FPS = 30  # frames per second, the general speed of the program
WINDOWWIDTH = 640  # size of window's width in pixels
WINDOWHEIGHT = 480  # size of windows' height in pixels
REVEALSPEED = 8  # speed boxes' sliding reveals and covers
BOXSIZE = 40  # size of box height & width in pixels
GAPSIZE = 10  # size of gap between boxes in pixels
HORIZONTALTILES = 5
VERTICALTILES = 5
BOARDWIDTH = HORIZONTALTILES*2  # number of columns of icons
BOARDHEIGHT = VERTICALTILES  # number of rows of icons

FEATURE_LEFT = 30  # percentage of items with feature (left field)
FEATURE_RIGHT = 30  # percentage of items with feature (right field)

# assert (BOARDWIDTH * BOARDHEIGHT) % 2 == 0, 'Board needs to have an even number of boxes for pairs of matches.'
XMARGIN = int((WINDOWWIDTH - (BOARDWIDTH * (BOXSIZE + GAPSIZE))) / 2)
YMARGIN = int((WINDOWHEIGHT - (BOARDHEIGHT * (BOXSIZE + GAPSIZE))) / 2)

#        R    G    B
GRAY = (100, 100, 100)
NAVYBLUE = (60,  60, 100)
WHITE = (255, 255, 255)
RED = (255,   0,   0)
GREEN = (0, 255,   0)
BLUE = (0,   0, 255)
YELLOW = (255, 255,   0)
ORANGE = (255, 128,   0)
PURPLE = (255,   0, 255)
CYAN = (0, 255, 255)
BLACK = (0, 0, 0)
GREY = (200, 200, 200)
ORANGE = (200, 100, 50)
TRANS = (1, 1, 1)


class Slider():
    def __init__(self, name, val, maxi, mini, xpos, ypos):
        self.val = val  # start value
        self.maxi = maxi  # maximum at slider position right
        self.mini = mini  # minimum at slider position left
        self.width = 300
        self.xpos = xpos-self.width//2  # x-location on screen
        self.ypos = ypos
        self.surf = pygame.surface.Surface((self.width, 50))
        self.hit = False  # the hit attribute indicates slider movement due to mouse interaction

        font = pygame.font.SysFont("Verdana", 12)

        self.txt_surf = font.render(name, 1, BLACK)
        self.txt_rect = self.txt_surf.get_rect(center=(self.width//2, 15))

        self.txt_surf1 = font.render(f"{mini}", 1, GREEN, BLUE)
        self.txt_rect1 = self.txt_surf1.get_rect(center=(10, 30))
        self.txt_surf2 = font.render(f"{maxi}", 1, GREEN, BLUE)
        self.txt_rect2 = self.txt_surf2.get_rect(center=(self.width-10, 30))
        self.txt_surf3 = font.render(f"{(maxi-mini)/2}", 1, GREEN, BLUE)
        self.txt_rect3 = self.txt_surf3.get_rect(center=(self.width//2, 30))

        # Static graphics - slider background #
        self.surf.fill((100, 100, 100))
        pygame.draw.rect(self.surf, GREY, [0, 0, self.width, 50], 3)
        pygame.draw.rect(self.surf, ORANGE, [10, 10, self.width-20, 10], 0)
        pygame.draw.rect(self.surf, WHITE, [10, 30, self.width-20, 5], 0)

        # this surface never changes
        self.surf.blit(self.txt_surf, self.txt_rect)
        self.surf.blit(self.txt_surf1, self.txt_rect1)
        self.surf.blit(self.txt_surf2, self.txt_rect2)
        self.surf.blit(self.txt_surf3, self.txt_rect3)

        # dynamic graphics - button surface #
        self.button_surf = pygame.surface.Surface((self.width-30, 20))
        self.button_surf.fill(TRANS)
        self.button_surf.set_colorkey(TRANS)
        pygame.draw.circle(self.button_surf, BLACK, (self.width//2, 10), 6, 0)
        pygame.draw.circle(self.button_surf, ORANGE, (self.width//2, 10), 4, 0)

    def draw(self, screen):
        """ Combination of static and dynamic graphics in a copy of
    the basic slide surface
    """
        # static
        surf = self.surf.copy()

        # dynamic
        pos = (int((self.val-self.mini)/(self.maxi-self.mini)*(self.width-30)), 33)
        self.button_rect = self.button_surf.get_rect(center=pos)
        surf.blit(self.button_surf, self.button_rect)
        # move of button box to correct screen position
        self.button_rect.move_ip(self.xpos, self.ypos)

        # screen
        screen.blit(surf, (self.xpos, self.ypos))

    def move(self):
        """
    The dynamic part; reacts to movement of the slider button.
    """
        self.val = (pygame.mouse.get_pos()[
                    0] - self.xpos - 30) / (self.width-30) * (self.maxi - self.mini) + self.mini
        if self.val < self.mini:
            self.val = self.mini
        if self.val > self.maxi:
            self.val = self.maxi


BGCOLOR = NAVYBLUE
LIGHTBGCOLOR = GRAY
BOXCOLOR = WHITE
HIGHLIGHTCOLOR = BLUE

BEETLE1 = 'beetle1'
BEETLE2 = 'beetle2'

ALLSHAPES = (BEETLE1, BEETLE2)


def main():
    global FPSCLOCK, DISPLAYSURF
    pygame.init()
    FPSCLOCK = pygame.time.Clock()
    DISPLAYSURF = pygame.display.set_mode((WINDOWWIDTH, WINDOWHEIGHT))
    clicked_order_l = []
    clicked_order_r = []

    mousex = 0  # used to store x coordinate of mouse event
    mousey = 0  # used to store y coordinate of mouse event
    pygame.display.set_caption('Generics and Alternatives')

    mainBoard = getRandomizedBoard(FEATURE_LEFT, FEATURE_RIGHT)
    revealedBoxes = generateRevealedBoxesData(False)

    # firstSelection = None  # stores the (x, y) of the first box clicked.
    font = pygame.font.Font('freesansbold.ttf', 32)
    text = font.render("0", True, GREEN, BLUE)
    textRectl = text.get_rect()
    textRectl.center = (WINDOWWIDTH // 4 + XMARGIN//2, YMARGIN//2)
    textRectr = text.get_rect()
    textRectr.center = (WINDOWWIDTH*3 // 4 - XMARGIN//2, YMARGIN//2)

    rate_loc = (WINDOWWIDTH-XMARGIN)
    rate = Slider("Beetles", 2.5, 5, 0, WINDOWWIDTH //
                  2, WINDOWHEIGHT - YMARGIN)

    DISPLAYSURF.fill(BGCOLOR)
    startGameAnimation(mainBoard)

    num = 0

    while True:  # main game loop
        mouseClicked = False
        stringl = f"{len(clicked_order_l)}"
        stringr = f"{len(clicked_order_r)}"
        textl = font.render(stringl, True, GREEN, BLUE)
        textr = font.render(stringr, True, GREEN, BLUE)
        DISPLAYSURF.fill(BGCOLOR)  # drawing the window
        DISPLAYSURF.blit(textl, textRectl)
        DISPLAYSURF.blit(textr, textRectr)
        drawBoard(mainBoard, revealedBoxes)

        for event in pygame.event.get():  # event handling loop
            if event.type == QUIT or (event.type == KEYUP and event.key == K_ESCAPE):
                pygame.quit()
                sys.exit()
            elif event.type == pygame.MOUSEBUTTONDOWN:
                pos = pygame.mouse.get_pos()
                if rate.button_rect.collidepoint(pos):
                    rate.hit = True
            elif event.type == MOUSEMOTION:
                mousex, mousey = event.pos
            elif event.type == MOUSEBUTTONUP:
                mousex, mousey = event.pos
                rate.hit = False
                mouseClicked = True
                print(rate.val)

        # Move slider
        if rate.hit:
            rate.move()

        rate.draw(DISPLAYSURF)

        boxx, boxy = getBoxAtPixel(mousex, mousey)
        if boxx != None and boxy != None:
            # The mouse is currently over a box.
            if not revealedBoxes[boxx][boxy]:
                drawHighlightBox(boxx, boxy)
            if not revealedBoxes[boxx][boxy] and mouseClicked:
                if boxx >= HORIZONTALTILES:
                    clicked_order_r.append(
                        [boxx-HORIZONTALTILES, boxy, getShape(mainBoard, boxx, boxy)])
                else:
                    clicked_order_l.append(
                        [boxx, boxy, getShape(mainBoard, boxx, boxy)])
                revealBoxesAnimation(mainBoard, [(boxx, boxy)])
                revealedBoxes[boxx][boxy] = True  # set the box as "revealed"
        # Redraw the screen and wait a clock tick.
        pygame.display.update()
        FPSCLOCK.tick(FPS)


def generateRevealedBoxesData(val):
    revealedBoxes = []
    for i in range(BOARDWIDTH):
        revealedBoxes.append([val] * BOARDHEIGHT)
    return revealedBoxes


def getRandomizedBoard(feature_left, feature_right):
    # Get a list of every possible shape in every possible color.
    icons_left = []
    icons_right = []
    num_diff_left = (feature_left*(HORIZONTALTILES*VERTICALTILES)//100)
    num_diff_right = (feature_left*(HORIZONTALTILES*VERTICALTILES)//100)
    for i in range(HORIZONTALTILES*VERTICALTILES):
        if i < num_diff_left:
            icons_left.append((ALLSHAPES[0]))
        else:
            icons_left.append((ALLSHAPES[1]))
        if i < num_diff_right:
            icons_right.append((ALLSHAPES[0]))
        else:
            icons_right.append((ALLSHAPES[1]))

    random.shuffle(icons_left)  # randomize the order of the icons list
    random.shuffle(icons_right)  # randomize the order of the icons list

    # Create the board data structure, with randomly placed icons.
    board = []
    for x in range(BOARDWIDTH):
        column = []
        for y in range(BOARDHEIGHT):
            if x >= HORIZONTALTILES:
                column.append(icons_right[0])
                del icons_right[0]
            else:
                column.append(icons_left[0])
                del icons_left[0]  # remove the icons as we assign them
        board.append(column)
    return board


def splitIntoGroupsOf(groupSize, theList):
    # splits a list into a list of lists, where the inner lists have at
    # most groupSize number of items.
    result = []
    for i in range(0, len(theList), groupSize):
        result.append(theList[i:i + groupSize])
    return result


def leftTopCoordsOfBox(boxx, boxy):
    # Convert board coordinates to pixel coordinates
    left = boxx * (BOXSIZE + GAPSIZE) + XMARGIN
    top = boxy * (BOXSIZE + GAPSIZE) + YMARGIN
    if boxx >= HORIZONTALTILES:
        left += GAPSIZE
    return (left, top)


def getBoxAtPixel(x, y):
    for boxx in range(BOARDWIDTH):
        for boxy in range(BOARDHEIGHT):
            left, top = leftTopCoordsOfBox(boxx, boxy)
            boxRect = pygame.Rect(left, top, BOXSIZE, BOXSIZE)
            if boxRect.collidepoint(x, y):
                return (boxx, boxy)
    return (None, None)


def drawIcon(shape, boxx, boxy):
    quarter = int(BOXSIZE * 0.25)  # syntactic sugar
    half = int(BOXSIZE * 0.5)  # syntactic sugar

    # get pixel coords from board coords
    left, top = leftTopCoordsOfBox(boxx, boxy)
    # Draw the shapes
    if shape == BEETLE1:
        beetle1 = pygame.image.load("beetle1.png")
        beetle1 = pygame.transform.scale(beetle1, (BOXSIZE, BOXSIZE))
        beetle1rect = beetle1.get_rect()
        beetle1rect.center = (left + half, top + half)
        DISPLAYSURF.blit(beetle1, beetle1rect)
    elif shape == BEETLE2:
        beetle2 = pygame.image.load("beetle2.png")
        beetle2 = pygame.transform.scale(beetle2, (BOXSIZE, BOXSIZE))
        beetle2rect = beetle2.get_rect()
        beetle2rect.center = (left + half, top + half)
        DISPLAYSURF.blit(beetle2, beetle2rect)
    else:  # UNKNOWN SHAPE
        pygame.draw.circle(DISPLAYSURF, RED,
                           (left + half, top + half), half - 5)
        pygame.draw.circle(DISPLAYSURF, BGCOLOR,
                           (left + half, top + half), quarter - 5)


def getShape(board, boxx, boxy):
    # shape value for x, y spot is stored in board[x][y][0]
    # color value for x, y spot is stored in board[x][y][1]
    return board[boxx][boxy]


def drawBoxCovers(board, boxes, coverage):
    # Draws boxes being covered/revealed. "boxes" is a list
    # of two-item lists, which have the x & y spot of the box.
    for box in boxes:
        left, top = leftTopCoordsOfBox(box[0], box[1])
        pygame.draw.rect(DISPLAYSURF, BGCOLOR, (left, top, BOXSIZE, BOXSIZE))
        shape = getShape(board, box[0], box[1])
        drawIcon(shape, box[0], box[1])
        if coverage > 0:  # only draw the cover if there is an coverage
            pygame.draw.rect(DISPLAYSURF, BOXCOLOR,
                             (left, top, coverage, BOXSIZE))
    pygame.display.update()
    FPSCLOCK.tick(FPS)


def revealBoxesAnimation(board, boxesToReveal):
    # Do the "box reveal" animation.
    for coverage in range(BOXSIZE, (-REVEALSPEED) - 1, -REVEALSPEED):
        drawBoxCovers(board, boxesToReveal, coverage)


def coverBoxesAnimation(board, boxesToCover):
    # Do the "box cover" animation.
    for coverage in range(0, BOXSIZE + REVEALSPEED, REVEALSPEED):
        drawBoxCovers(board, boxesToCover, coverage)


def drawBoard(board, revealed):
    # Draws all of the boxes in their covered or revealed state.
    pygame.draw.line(DISPLAYSURF, BOXCOLOR, (WINDOWWIDTH //
                                             2, YMARGIN-GAPSIZE), (WINDOWWIDTH//2, WINDOWHEIGHT-YMARGIN))
    for boxx in range(BOARDWIDTH):
        for boxy in range(BOARDHEIGHT):
            left, top = leftTopCoordsOfBox(boxx, boxy)
            if not revealed[boxx][boxy]:
                # Draw a covered box.
                pygame.draw.rect(DISPLAYSURF, BOXCOLOR,
                                 (left, top, BOXSIZE, BOXSIZE))
            else:
                # Draw the (revealed) icon.
                shape = getShape(board, boxx, boxy)
                drawIcon(shape, boxx, boxy)


def drawHighlightBox(boxx, boxy):
    left, top = leftTopCoordsOfBox(boxx, boxy)
    pygame.draw.rect(DISPLAYSURF, HIGHLIGHTCOLOR, (left - 5,
                                                   top - 5, BOXSIZE + 10, BOXSIZE + 10), 4)


def startGameAnimation(board):
    # Randomly reveal the boxes 8 at a time.
    coveredBoxes = generateRevealedBoxesData(False)
    boxes = []
    for x in range(BOARDWIDTH):
        for y in range(BOARDHEIGHT):
            boxes.append((x, y))
    random.shuffle(boxes)
    boxGroups = splitIntoGroupsOf(8, boxes)

    drawBoard(board, coveredBoxes)
    # for boxGroup in boxGroups:
    #     revealBoxesAnimation(board, boxGroup)
    #     coverBoxesAnimation(board, boxGroup)


def gameWonAnimation(board):
    # flash the background color when the player has won
    coveredBoxes = generateRevealedBoxesData(True)
    color1 = LIGHTBGCOLOR
    color2 = BGCOLOR

    for i in range(13):
        color1, color2 = color2, color1  # swap colors
        DISPLAYSURF.fill(color1)
        drawBoard(board, coveredBoxes)
        pygame.display.update()
        pygame.time.wait(300)


def hasWon(revealedBoxes):
    # Returns True if all the boxes have been revealed, otherwise False
    for i in revealedBoxes:
        if False in i:
            return False  # return False if any boxes are covered.
    return True


if __name__ == '__main__':
    main()
