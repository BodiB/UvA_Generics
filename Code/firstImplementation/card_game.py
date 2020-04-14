import math
import random
import sys

import pygame
from pygame.locals import *


class Slider():
    def __init__(self, name, val, maxi, mini, xpos, ypos):
        self.val = int(val)  # start value
        self.maxi = maxi  # maximum at slider position right
        self.mini = mini  # minimum at slider position left
        self.width = 300
        self.height = 80
        self.spacing_left_side = 30
        self.spacing_right_side = (self.width - self.spacing_left_side)
        self.slider_width = self.width - 2 * self.spacing_left_side
        self.xpos = xpos - self.width // 2  # x-location on screen
        self.ypos = ypos
        self.surf = pygame.surface.Surface((self.width, self.height))
        self.hit = False  # the hit attribute indicates slider movement due to mouse interaction
        self.GREEN = (0, 255,   0)
        self.BLUE = (0,   0, 255)
        self.ORANGE = (255, 128,   0)
        self.BLACK = (0, 0, 0)
        self.GREY = (200, 200, 200)
        self.WHITE = (255, 255, 255)
        self.TRANS = (1, 1, 1)

        font = pygame.font.SysFont("Verdana", 12)

        # Draw the question at hand.
        self.txt_surf = font.render(name, 1, self.BLACK)
        self.txt_rect = self.txt_surf.get_rect(
            center=(self.width // 2, self.height // 8))

        # Static graphics - slider background #
        self.surf.fill((100, 100, 100))
        pygame.draw.rect(self.surf, self.GREY, [
                         0, 0, self.width, self.height], 3)
        pygame.draw.rect(self.surf, self.ORANGE, [
                         10, 5, self.width - 20, 10], 0)
        pygame.draw.rect(self.surf, self.WHITE, [
            self.spacing_left_side, self.height * 6 // 8, self.slider_width, 5], 0)

        # Text to be drawn on the surface for spacing and others.
        self.txt_surf1 = font.render(f"{mini}", 1, self.GREEN, self.BLUE)
        self.txt_rect1 = self.txt_surf1.get_rect(
            center=(self.spacing_left_side, self.height * 5 // 8))
        self.txt_surf1_1 = font.render("Not at all", 1, self.GREEN, self.BLUE)
        self.txt_rect1_1 = self.txt_surf1_1.get_rect(
            center=(self.spacing_left_side, self.height * 3 // 8))
        self.txt_surf2 = font.render(f"{maxi}", 1, self.GREEN, self.BLUE)
        self.txt_rect2 = self.txt_surf2.get_rect(
            center=(self.spacing_right_side, self.height * 5 // 8))
        self.txt_surf2_1 = font.render(f"Certainly", 1, self.GREEN, self.BLUE)
        self.txt_rect2_1 = self.txt_surf2_1.get_rect(
            center=(self.spacing_right_side, self.height * 3 // 8))
        self.txt_surf3 = font.render(f"Val: {self.val}", 1, self.GREEN, self.BLUE)
        self.txt_rect3 = self.txt_surf3.get_rect(
            center=(self.spacing_left_side + self.slider_width * 3 / 5, self.height * 3 // 8))

        # Draw spacing between mini and maxi
        self.txt_surf_spacing1 = font.render(f"{(maxi-mini)*1//5}", 1, self.GREEN, self.BLUE)
        self.txt_rect_spacing1 = self.txt_surf_spacing1.get_rect(
            center=(self.spacing_left_side + self.slider_width * 1 / 5, self.height * 5 // 8))
        self.txt_surf_spacing2 = font.render(f"{(maxi-mini)*2//5}", 1, self.GREEN, self.BLUE)
        self.txt_rect_spacing2 = self.txt_surf_spacing2.get_rect(
            center=(self.spacing_left_side + self.slider_width * 2 / 5, self.height * 5 // 8))
        self.txt_surf_spacing3 = font.render(f"{(maxi-mini)*3//5}", 1, self.GREEN, self.BLUE)
        self.txt_rect_spacing3 = self.txt_surf_spacing3.get_rect(
            center=(self.spacing_left_side + self.slider_width * 3 / 5, self.height * 5 // 8))
        self.txt_surf_spacing4 = font.render(f"{(maxi-mini)*4//5}", 1, self.GREEN, self.BLUE)
        self.txt_rect_spacing4 = self.txt_surf_spacing4.get_rect(
            center=(self.spacing_left_side + self.slider_width * 4 / 5, self.height * 5 // 8))

        # Text surfaces; Spacing of borders of the range
        self.surf.blit(self.txt_surf, self.txt_rect)
        self.surf.blit(self.txt_surf1, self.txt_rect1)
        self.surf.blit(self.txt_surf1_1, self.txt_rect1_1)
        self.surf.blit(self.txt_surf2, self.txt_rect2)
        self.surf.blit(self.txt_surf2_1, self.txt_rect2_1)
        self.surf.blit(self.txt_surf3, self.txt_rect3)

        # Text surfaces; Draw spacing between range
        self.surf.blit(self.txt_surf_spacing1, self.txt_rect_spacing1)
        self.surf.blit(self.txt_surf_spacing2, self.txt_rect_spacing2)
        self.surf.blit(self.txt_surf_spacing3, self.txt_rect_spacing3)
        self.surf.blit(self.txt_surf_spacing4, self.txt_rect_spacing4)

        # dynamic graphics - button surface #
        # Surface on which you can "grab" the slider
        self.button_surf = pygame.surface.Surface(
            (self.slider_width, 20))
        self.button_surf.fill(self.TRANS)
        self.button_surf.set_colorkey(self.TRANS)
        pygame.draw.circle(self.button_surf, self.BLACK,
                           (self.width // 2, 15), 6, 0)
        pygame.draw.circle(self.button_surf, self.ORANGE,
                           (self.width // 2, 15), 4, 0)

    def draw(self, screen):
        """ Combination of static and dynamic graphics in a copy of
    the basic slide surface
    """
        # static
        surf = self.surf.copy()

        # dynamic
        pos = (int((self.val - self.mini) / (self.maxi - self.mini)
                   * (self.slider_width)), self.height * 6 // 8)
        self.button_rect = self.button_surf.get_rect(center=pos)
        surf.blit(self.button_surf, self.button_rect)
        # move of button box to correct screen position
        self.button_rect.move_ip(self.xpos, self.ypos)

        font = pygame.font.SysFont("Verdana", 12)
        self.txt_surf3 = font.render(f"Val: {self.val}", 1, self.GREEN, self.BLUE)
        self.txt_rect3 = self.txt_surf3.get_rect(
            center=(self.spacing_left_side + self.slider_width * 3 / 5, self.height * 3 // 8))
        surf.blit(self.txt_surf3, self.txt_rect3)
        # screen
        screen.blit(surf, (self.xpos, self.ypos))

    def move(self):
        """
    The dynamic part; reacts to movement of the slider button.
    """
        self.val = (pygame.mouse.get_pos()[
                    0] - self.xpos - 30) / (self.width - 30) * (self.maxi - self.mini) + self.mini
        self.val = int(round(self.val, 0))
        if self.val < self.mini:
            self.val = self.mini
        if self.val > self.maxi:
            self.val = self.maxi


class Card_Game(object):
    def __init__(self):
        self.FPS = 30  # frames per second, the general speed of the program
        self.WINDOWWIDTH = 640  # size of window's width in pixels
        self.WINDOWHEIGHT = 480  # size of windows' height in pixels
        self.REVEALSPEED = 8  # speed boxes' sliding reveals and covers
        self.BOXSIZE = 40  # size of box height & width in pixels
        self.GAPSIZE = 10  # size of gap between boxes in pixels
        self.HORIZONTALTILES = 5
        self.VERTICALTILES = 5
        self.BOARDWIDTH = self.HORIZONTALTILES * 2  # number of columns of icons
        self.BOARDHEIGHT = self.VERTICALTILES  # number of rows of icons

        self.FEATURE_LEFT = 30  # percentage of items with feature (left field)
        # percentage of items with feature (right field)
        self.FEATURE_RIGHT = 30

        # assert (BOARDWIDTH * BOARDHEIGHT) % 2 == 0, 'Board needs to have an even number of boxes for pairs of matches.'
        self.XMARGIN = int(
            (self.WINDOWWIDTH - (self.BOARDWIDTH * (self.BOXSIZE + self.GAPSIZE))) / 2)
        self.YMARGIN = int(
            (self.WINDOWHEIGHT - (self.BOARDHEIGHT * (self.BOXSIZE + self.GAPSIZE))) / 2)

        #        R    G    B
        self.GRAY = (100, 100, 100)
        self.NAVYBLUE = (60,  60, 100)
        self.WHITE = (255, 255, 255)
        self.RED = (255,   0,   0)
        self.GREEN = (0, 255,   0)
        self.BLUE = (0,   0, 255)
        self.YELLOW = (255, 255,   0)
        self.ORANGE = (255, 128,   0)
        self.PURPLE = (255,   0, 255)
        self.CYAN = (0, 255, 255)
        self.BLACK = (0, 0, 0)
        self.GREY = (200, 200, 200)
        self.TRANS = (1, 1, 1)

        self.SCALEMAX = 5
        self.SCALEMIN = 0
        self.BGCOLOR = self.NAVYBLUE
        self.LIGHTBGCOLOR = self.GRAY
        self.BOXCOLOR = self.WHITE
        self.HIGHLIGHTCOLOR = self.BLUE

        self.BEETLE1 = 'beetle1'
        self.BEETLE2 = 'beetle2'

        self.ALLSHAPES = (self.BEETLE1, self.BEETLE2)

    def main(self, question):
        global FPSCLOCK, DISPLAYSURF
        pygame.init()
        FPSCLOCK = pygame.time.Clock()
        DISPLAYSURF = pygame.display.set_mode(
            (self.WINDOWWIDTH, self.WINDOWHEIGHT))
        clicked_order = []

        mousex = 0  # used to store x coordinate of mouse event
        mousey = 0  # used to store y coordinate of mouse event
        pygame.display.set_caption('Generics and Alternatives')

        mainBoard = Card_Game.getRandomizedBoard(self)
        revealedBoxes = Card_Game.generateRevealedBoxesData(self, False)

        # firstSelection = None  # stores the (x, y) of the first box clicked.
        font = pygame.font.Font('freesansbold.ttf', 32)
        text = font.render("0", True, self.GREEN, self.BLUE)
        textRectl = text.get_rect()
        textRectl.center = (self.WINDOWWIDTH // 4 +
                            self.XMARGIN // 2, self.YMARGIN // 2)
        textRectr = text.get_rect()
        textRectr.center = (self.WINDOWWIDTH * 3 // 4 -
                            self.XMARGIN // 2, self.YMARGIN // 2)

        rate_loc = (self.WINDOWWIDTH - self.XMARGIN)
        rate = Slider(question, 2.5, self.SCALEMAX, self.SCALEMIN, self.WINDOWWIDTH //
                      2, self.WINDOWHEIGHT - self.YMARGIN)

        DISPLAYSURF.fill(self.BGCOLOR)
        Card_Game.startGameAnimation(self, mainBoard)

        num = 0

        while True:  # main game loop
            mouseClicked = False
            DISPLAYSURF.fill(self.BGCOLOR)  # drawing the window
            Card_Game.drawBoard(self, mainBoard, revealedBoxes)

            # Submit 'button'
            button_surface = font.render(">>", 3, self.RED)
            button_text = button_surface.get_rect(
                center=(self.WINDOWWIDTH - 60, self.WINDOWHEIGHT - 35))
            button = pygame.draw.rect(
                DISPLAYSURF, self.WHITE, (self.WINDOWWIDTH - 110, self.WINDOWHEIGHT - 60, 100, 50))
            DISPLAYSURF.blit(button_surface, button_text)

            for event in pygame.event.get():  # event handling loop
                if event.type == QUIT or (event.type == KEYUP and event.key == K_ESCAPE):
                    pygame.quit()
                    sys.exit()
                elif event.type == pygame.MOUSEBUTTONDOWN:
                    pos = pygame.mouse.get_pos()
                    if event.button == 1:
                        # `event.pos` is the mouse position.
                        if button.collidepoint(event.pos):
                            # Submit and reset for new view
                            data = Card_Game.packData(
                                self, clicked_order, rate.val)
                            return data
                            # SET NEXT SCREEN BASED ON PREVIOUS ANSWER?
                        if rate.button_rect.collidepoint(pos):
                            rate.hit = True
                elif event.type == MOUSEMOTION:
                    mousex, mousey = event.pos
                elif event.type == MOUSEBUTTONUP:
                    mousex, mousey = event.pos
                    rate.hit = False
                    mouseClicked = True

            # Move slider
            if rate.hit:
                rate.move()

            rate.draw(DISPLAYSURF)

            boxx, boxy = Card_Game.getBoxAtPixel(self, mousex, mousey)
            if boxx != None and boxy != None:
                # The mouse is currently over a box.
                if not revealedBoxes[boxx][boxy]:
                    Card_Game.drawHighlightBox(self, boxx, boxy)
                if not revealedBoxes[boxx][boxy] and mouseClicked:
                    if boxx >= self.HORIZONTALTILES:
                        clicked_order.append(
                            ['R', boxx - self.HORIZONTALTILES, boxy, Card_Game.getShape(self, mainBoard, boxx, boxy)])
                    else:
                        clicked_order.append(
                            ['L', boxx, boxy, Card_Game.getShape(self, mainBoard, boxx, boxy)])
                    Card_Game.revealBoxesAnimation(
                        self, mainBoard, [(boxx, boxy)])
                    # set the box as "revealed"
                    revealedBoxes[boxx][boxy] = True
            # Redraw the screen and wait a clock tick.
            pygame.display.update()
            FPSCLOCK.tick(self.FPS)

    def generateRevealedBoxesData(self, val):
        revealedBoxes = []
        for i in range(self.BOARDWIDTH):
            revealedBoxes.append([val] * self.BOARDHEIGHT)
        return revealedBoxes

    def getRandomizedBoard(self):
        # Get a list of every possible shape in every possible color.
        icons_left = []
        icons_right = []
        num_diff_left = (
            self.FEATURE_LEFT * (self.HORIZONTALTILES * self.VERTICALTILES) // 100)
        num_diff_right = (
            self.FEATURE_RIGHT * (self.HORIZONTALTILES * self.VERTICALTILES) // 100)
        for i in range(self.HORIZONTALTILES * self.VERTICALTILES):
            if i < num_diff_left:
                icons_left.append((self.ALLSHAPES[0]))
            else:
                icons_left.append((self.ALLSHAPES[1]))
            if i < num_diff_right:
                icons_right.append((self.ALLSHAPES[0]))
            else:
                icons_right.append((self.ALLSHAPES[1]))

        random.shuffle(icons_left)  # randomize the order of the icons list
        random.shuffle(icons_right)  # randomize the order of the icons list

        # Create the board data structure, with randomly placed icons.
        board = []
        for x in range(self.BOARDWIDTH):
            column = []
            for y in range(self.BOARDHEIGHT):
                if x >= self.HORIZONTALTILES:
                    column.append(icons_right[0])
                    del icons_right[0]
                else:
                    column.append(icons_left[0])
                    del icons_left[0]  # remove the icons as we assign them
            board.append(column)
        return board

    def splitIntoGroupsOf(self, groupSize, theList):
        # splits a list into a list of lists, where the inner lists have at
        # most groupSize number of items.
        result = []
        for i in range(0, len(theList), groupSize):
            result.append(theList[i:i + groupSize])
        return result

    def leftTopCoordsOfBox(self, boxx, boxy):
        # Convert board coordinates to pixel coordinates
        left = boxx * (self.BOXSIZE + self.GAPSIZE) + self.XMARGIN
        top = boxy * (self.BOXSIZE + self.GAPSIZE) + self.YMARGIN
        if boxx >= self.HORIZONTALTILES:
            left += self.GAPSIZE
        return (left, top)

    def getBoxAtPixel(self, x, y):
        for boxx in range(self.BOARDWIDTH):
            for boxy in range(self.BOARDHEIGHT):
                left, top = Card_Game.leftTopCoordsOfBox(self, boxx, boxy)
                boxRect = pygame.Rect(left, top, self.BOXSIZE, self.BOXSIZE)
                if boxRect.collidepoint(x, y):
                    return (boxx, boxy)
        return (None, None)

    def drawIcon(self, shape, boxx, boxy):
        quarter = int(self.BOXSIZE * 0.25)  # syntactic sugar
        half = int(self.BOXSIZE * 0.5)  # syntactic sugar

        # get pixel coords from board coords
        left, top = Card_Game.leftTopCoordsOfBox(self, boxx, boxy)
        # Draw the shapes
        if shape == self.BEETLE1:
            beetle1 = pygame.image.load("beetle1.png")
            beetle1 = pygame.transform.scale(
                beetle1, (self.BOXSIZE, self.BOXSIZE))
            beetle1rect = beetle1.get_rect()
            beetle1rect.center = (left + half, top + half)
            DISPLAYSURF.blit(beetle1, beetle1rect)
        elif shape == self.BEETLE2:
            beetle2 = pygame.image.load("beetle2.png")
            beetle2 = pygame.transform.scale(
                beetle2, (self.BOXSIZE, self.BOXSIZE))
            beetle2rect = beetle2.get_rect()
            beetle2rect.center = (left + half, top + half)
            DISPLAYSURF.blit(beetle2, beetle2rect)
        else:  # UNKNOWN SHAPE
            pygame.draw.circle(DISPLAYSURF, self.RED,
                               (left + half, top + half), half - 5)
            pygame.draw.circle(DISPLAYSURF, self.BGCOLOR,
                               (left + half, top + half), quarter - 5)

    def getShape(self, board, boxx, boxy):
        # shape value for x, y spot is stored in board[x][y][0]
        # color value for x, y spot is stored in board[x][y][1]
        return board[boxx][boxy]

    def drawBoxCovers(self, board, boxes, coverage):
        # Draws boxes being covered/revealed. "boxes" is a list
        # of two-item lists, which have the x & y spot of the box.
        for box in boxes:
            left, top = Card_Game.leftTopCoordsOfBox(self, box[0], box[1])
            pygame.draw.rect(DISPLAYSURF, self.BGCOLOR,
                             (left, top, self.BOXSIZE, self.BOXSIZE))
            shape = Card_Game.getShape(self, board, box[0], box[1])
            Card_Game.drawIcon(self, shape, box[0], box[1])
            if coverage > 0:  # only draw the cover if there is an coverage
                pygame.draw.rect(DISPLAYSURF, self.BOXCOLOR,
                                 (left, top, coverage, self.BOXSIZE))
        pygame.display.update()
        FPSCLOCK.tick(self.FPS)

    def revealBoxesAnimation(self, board, boxesToReveal):
        # Do the "box reveal" animation.
        for coverage in range(self.BOXSIZE, (-self.REVEALSPEED) - 1, -self.REVEALSPEED):
            Card_Game.drawBoxCovers(self, board, boxesToReveal, coverage)

    def drawBoard(self, board, revealed):
        # Draws all of the boxes in their covered or revealed state.
        font = pygame.font.Font('freesansbold.ttf', 16)
        left_surface = font.render("Marchena Hide Beetles", 3, self.GREEN)
        left_text = left_surface.get_rect(
            center=(self.WINDOWWIDTH//4, 20))
        right_surface = font.render("Genovesa Hide Beetles", 3, self.GREEN)
        right_text = right_surface.get_rect(
            center=(self.WINDOWWIDTH*3//4, 20))
        # Draw the titles
        DISPLAYSURF.blit(left_surface, left_text)
        DISPLAYSURF.blit(right_surface, right_text)
        # Draw Centerline
        pygame.draw.line(DISPLAYSURF, self.BOXCOLOR, (self.WINDOWWIDTH //
                                                      2, self.YMARGIN - self.GAPSIZE), (self.WINDOWWIDTH // 2, self.WINDOWHEIGHT - self.YMARGIN))
        for boxx in range(self.BOARDWIDTH):
            for boxy in range(self.BOARDHEIGHT):
                left, top = Card_Game.leftTopCoordsOfBox(self, boxx, boxy)
                if not revealed[boxx][boxy]:
                    # Draw a covered box.
                    pygame.draw.rect(DISPLAYSURF, self.BOXCOLOR,
                                     (left, top, self.BOXSIZE, self.BOXSIZE))
                else:
                    # Draw the (revealed) icon.
                    shape = Card_Game.getShape(self, board, boxx, boxy)
                    Card_Game.drawIcon(self, shape, boxx, boxy)

    def drawHighlightBox(self, boxx, boxy):
        left, top = Card_Game.leftTopCoordsOfBox(self, boxx, boxy)
        pygame.draw.rect(DISPLAYSURF, self.HIGHLIGHTCOLOR, (left - 5,
                                                            top - 5, self.BOXSIZE + 10, self.BOXSIZE + 10), 4)

    def startGameAnimation(self, board):
        # Randomly reveal the boxes 8 at a time.
        coveredBoxes = Card_Game.generateRevealedBoxesData(self, False)
        boxes = []
        for x in range(self.BOARDWIDTH):
            for y in range(self.BOARDHEIGHT):
                boxes.append((x, y))
        random.shuffle(boxes)
        boxGroups = Card_Game.splitIntoGroupsOf(self, 8, boxes)

        Card_Game.drawBoard(self, board, coveredBoxes)
        for boxGroup in boxGroups:
            Card_Game.revealBoxesAnimation(self, board, boxGroup)

    def packData(self, order, rating):
        # Collect the gathered data and pack it in a dict. (SHOULD BECOME DATABASE.)
        size = (self.HORIZONTALTILES * self.VERTICALTILES)
        submit = {
            "ClickOrder": order,
            "ClickedLeft": sum(x.count('L') for x in order),
            "ClickedRight": sum(x.count('R') for x in order),
            "DifferentLeft%": self.FEATURE_LEFT,
            "DifferentRight%": self.FEATURE_RIGHT,
            "NumTilesPerSide": size,
            "DifferentLeft": (self.FEATURE_LEFT * size // 100),
            "DifferentRight": (self.FEATURE_RIGHT * size // 100),
            "Rating": rating,
            "Scale[Min,Max]": [self.SCALEMIN, self.SCALEMAX]
        }
        return submit


if __name__ == '__main__':
    questionnaire = Card_Game()
    questionnaire.main("Hide Beetles from Genovesa have green wings.")
