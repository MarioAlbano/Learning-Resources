unit Unit1;

interface

uses
  Winapi.Windows, Winapi.Messages, System.SysUtils, System.Variants, System.Classes, Vcl.Graphics,
  Vcl.Controls, Vcl.Forms, Vcl.Dialogs, Vcl.StdCtrls, Vcl.ExtCtrls, Vcl.Menus;

type
  TForm1 = class(TForm)
    Panel1: TPanel;
    Button1: TButton;
    Edit1: TEdit;
    Edit2: TEdit;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Panel2: TPanel;
    RadioButton1: TRadioButton;
    Dropdown: TMainMenu;
    N1: TMenuItem;
    este1: TMenuItem;
    este21: TMenuItem;
    Memo1: TMemo;
    ListBox1: TListBox;
    ScrollBar1: TScrollBar;
    ComboBox1: TComboBox;
    procedure Button1Click(Sender: TObject);
    procedure este1Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  num1: integer;
  num2: integer;
  sumResult: integer;

implementation

{$R *.dfm}


procedure TForm1.Button1Click(Sender: TObject);
begin
num1 := StrToInt(Edit1.Text);
num2 := StrToInt(Edit2.Text);

sumResult := num1 + num2;
Label2.Caption := IntToStr(sumResult);
end;

procedure TForm1.este1Click(Sender: TObject);
begin
      ShowMessage('Clicou!');
end;

end.
