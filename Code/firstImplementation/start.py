textString = "Thank you for taking interest in this study!\n\nWe invite you to participate in a research study on language production and comprehension.  In this survey you will be asked to judge whether a sentence can be correctly asserted in a given scenario.\n\nCompleting the survey will take you approximately 4 minutes.\n\nPlease complete this survey in one go. In other words, please only participate in this survey, if you have 4 to 6 minutes that you can dedicate to it.\n\nIf you would like to contact the Principal Investigator in the study to discuss this research, please e-mail k.schulz@uva.nl."


consentText = "I understand that all data will be kept confidential by the researcher. My personal information will not be stored with the data. I am free to withdraw at any time without giving a reason.\n\nI consent to the publication of study results as long as the information is anonymous so that no identification of participants can be made."
agreeText = "I have read and understand the explanations and I\nvoluntarily consent to participate in this study."
disAgreeText = "I do not consent to participate in this study."

import tkinter as tk
from card_game import Card_Game, Slider


class Main(object):
    """
    Welcome screen
    """

    def __init__(self):
        self.value = None
        self.root = None

    def show(self):
        '''Show the window, and wait for the user to click a button'''

        self.root = tk.Tk()
        true_button = tk.Button(self.root, text=">>",
                                command=lambda: self.finish(True))

        text2 = tk.Text(self.root, wrap='word', height=20)
        text2.insert(tk.END, textString, 'color')
        text2.config(state='disabled')
        text2.pack(side=tk.TOP)
        true_button.pack()

        # start the loop, and wait for the dialog to be
        # destroyed. Then, return the value:
        self.root.mainloop()
        return self.value

    def finish(self, value):
        '''Set the value and close the window

        This will cause the show() function to return.
        '''
        self.value = value
        self.root.destroy()


class Consent(object):
    """
    Consent form
    """

    def __init__(self):
        self.value = None
        self.root = None

    def show(self):
        '''Show the window, and wait for the user to click a button'''

        self.root = tk.Tk()
        true_button = tk.Button(self.root, text=agreeText,
                                command=lambda: self.finish(True))
        false_button = tk.Button(self.root, text=disAgreeText,
                                 command=lambda: self.finish(False))

        text2 = tk.Text(self.root, wrap='word', height=20)
        text2.insert(tk.END, consentText, 'color')
        text2.config(state='disabled')
        text2.pack(side=tk.TOP)
        true_button.pack()
        false_button.pack()

        # start the loop, and wait for the dialog to be
        # destroyed. Then, return the value:
        self.root.mainloop()
        return self.value

    def finish(self, value):
        '''Set the value and close the window

        This will cause the show() function to return.
        '''
        self.value = value
        self.root.destroy()


if __name__ == '__main__':
    next = Main().show()
    if next:
        agree = Consent().show()
        if agree:
            print("AGREED")
            questionnaire = Card_Game()
            print(questionnaire.main("Hide Beetles from Genovesa have green wings."))
    quit()
