using System;
using System.Speech.Recognition;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace LibreCat
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        Dictionary<string, string> app_state = new Dictionary<string, string>();
        public MainWindow()
        {
            InitializeComponent();
        }

        //private void SearchBox_GotKeyboardFocus(object sender, KeyboardFocusChangedEventArgs e)
        //{
        //    TextBox source = e.Source as TextBox;

        //    if (source != null && app_state["search_focused"])
        //    {
        //        source.Text = "";
        //    }
        //}

        //private void Search_Q_Chnged(object sender, TextChangedEventArgs e)
        //{
        //    TextBox source = e.Source as TextBox;
        //    if (source != null)
        //    {
        //        state["search_q"] = source.Text;
        //    }
        //}

        private void speech_rec(object sender, RoutedEventArgs e)
        {
            SpeechRecognizer speechRecognizer = new SpeechRecognizer();
        }
    }
}
