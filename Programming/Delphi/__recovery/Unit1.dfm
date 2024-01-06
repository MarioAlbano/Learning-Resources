object Form1: TForm1
  Left = 0
  Top = 0
  Caption = 'Form1'
  ClientHeight = 487
  ClientWidth = 667
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -12
  Font.Name = 'Segoe UI'
  Font.Style = []
  Menu = Dropdown
  WindowState = wsMaximized
  TextHeight = 15
  object Label3: TLabel
    Left = 256
    Top = 56
    Width = 213
    Height = 42
    Alignment = taCenter
    Caption = 'Soma N'#250'meros'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -35
    Font.Name = 'Arial Narrow'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Panel1: TPanel
    Left = 192
    Top = 160
    Width = 321
    Height = 121
    TabOrder = 0
    object Label1: TLabel
      Left = 191
      Top = 16
      Width = 8
      Height = 15
      Caption = '='
    end
    object Label2: TLabel
      Left = 232
      Top = 23
      Width = 3
      Height = 15
    end
    object Button1: TButton
      Left = 112
      Top = 80
      Width = 113
      Height = 25
      Cursor = crHandPoint
      Caption = 'Somar N'#250'meros'
      TabOrder = 0
      OnClick = Button1Click
    end
    object Edit1: TEdit
      Left = 40
      Top = 16
      Width = 57
      Height = 23
      TabOrder = 1
    end
    object Edit2: TEdit
      Left = 112
      Top = 16
      Width = 57
      Height = 23
      TabOrder = 2
    end
  end
  object Panel2: TPanel
    Left = 88
    Top = 104
    Width = 505
    Height = 41
    Color = clAqua
    ParentBackground = False
    TabOrder = 1
    object RadioButton1: TRadioButton
      Left = 1
      Top = 1
      Width = 503
      Height = 39
      Align = alClient
      Caption = 'RadioButton1'
      TabOrder = 0
    end
  end
  object Memo1: TMemo
    Left = 352
    Top = 344
    Width = 185
    Height = 89
    Lines.Strings = (
      'Memo1')
    TabOrder = 2
  end
  object ListBox1: TListBox
    Left = 136
    Top = 296
    Width = 121
    Height = 97
    ItemHeight = 15
    TabOrder = 3
  end
  object ScrollBar1: TScrollBar
    Left = 576
    Top = 224
    Width = 121
    Height = 17
    PageSize = 0
    TabOrder = 4
  end
  object ComboBox1: TComboBox
    Left = 88
    Top = 192
    Width = 145
    Height = 23
    TabOrder = 5
    Text = 'ComboBox1'
  end
  object Dropdown: TMainMenu
    Left = 72
    Top = 40
    object N1: TMenuItem
      Caption = 'Teste00'
      object este1: TMenuItem
        Caption = 'Teste'
        OnClick = este1Click
      end
      object este21: TMenuItem
        Caption = 'Teste2'
      end
    end
  end
end
