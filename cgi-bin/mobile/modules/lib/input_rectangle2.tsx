// noPage

import { LibComponent } from 'esoftplay/cache/lib/component/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibUtils } from 'esoftplay/cache/lib/utils/import';
import { createTimeout } from 'esoftplay/timeout';

import React from 'react';
import { Text, TextInput, TouchableOpacity, View } from 'react-native';

export interface LibInput_rectangle2Props {
  icon?: string,
  label?: string,
  placeholder?: string,
  mask?: string,
  maskFrom?: 'start' | 'end',
  suffix?: string,
  onPress?: () => void,
  helper?: string
  allowFontScaling?: boolean,
  autoCapitalize?: "none" | "sentences" | "words" | "characters",
  autoCorrect?: boolean,
  autoFocus?: boolean,
  blurOnSubmit?: boolean,
  caretHidden?: boolean,
  contextMenuHidden?: boolean,
  defaultValue?: string,
  editable?: boolean,
  inactive?: boolean,
  keyboardType?: "default" | "email-address" | "numeric" | "phone-pad",
  maxLength?: number,
  multiline?: boolean,
  onSubmitEditing?: () => void,
  onChangeText?: (text: string) => void,
  placeholderTextColor?: string,
  returnKeyType?: "done" | "go" | "next" | "search" | "send",
  secureTextEntry?: boolean,
  selectTextOnFocus?: boolean,
  selectionColor?: string,
  style?: any,
  inputStyle?: any,
  value?: string,
  close?: boolean,
  dropdown?: boolean,
  hint?: string
}

export interface LibInputState {
  hasFocus: boolean,
  error?: string,
  helper?: string
}
export default class m extends LibComponent<LibInput_rectangle2Props, LibInputState>{
  text: string
  ref: any
  constructor(props: LibInput_rectangle2Props) {
    super(props);
    this.state = { hasFocus: false }
    this.text = ''
    this.ref = React.createRef()
    this.getText = this.getText.bind(this);
    this.mask = this.mask.bind(this);
    this.unmask = this.unmask.bind(this);
    this.setError = this.setError.bind(this);
    this.clearError = this.clearError.bind(this);
    this.setHelper = this.setHelper.bind(this);
    this.clearHelper = this.clearHelper.bind(this);
    this.getTextMasked = this.getTextMasked.bind(this);
  }

  getText(): string {
    return this.unmask(this.text)
  }

  getTextMasked(): string {
    return this.text
  }

  focus(): void {
    this.ref.focus()
  }

  blur(): void {
    this.ref.blur()
  }

  setHelper(msg: string): void {
    this.setState({
      helper: msg,
      hasFocus: false
    })
  }

  clearHelper(): void {
    this.setState({
      helper: undefined,
      hasFocus: false
    })
  }

  setError(msg: string): void {
    this.setState({
      error: msg,
      hasFocus: false
    })
  }

  clearError(): void {
    this.setState({
      error: undefined,
      hasFocus: false
    })
  }

  mask(text: string): string {
    let _text = text
    let { mask, maskFrom } = this.props
    if (mask) {
      if (!maskFrom) maskFrom = 'start'
      let rMask = mask.split("")
      let rText = this.unmask(_text).split("")
      if (maskFrom == 'end') {
        rMask = [...rMask.reverse()]
        rText = [...rText.reverse()]
      }
      let maskedText = ''
      var _addRange = 0
      var _addMaskChar = ''
      for (let i = 0; i < rMask.length; i++) {
        const iMask = rMask[i];
        if (iMask == '#') {
          if (rText[i - _addRange] != undefined) {
            maskedText += _addMaskChar + rText[i - _addRange]
          }
          else {
            break
          }
          _addMaskChar = ''
        }
        else {
          _addMaskChar += iMask
          _addRange++
        }
      }
      if (maskFrom == 'end') {
        maskedText = maskedText.split('').reverse().join('')
      }
      this.ref.setNativeProps({ text: maskedText })
      return maskedText
    }
    return _text
  }

  unmask(text: string): string {
    let _text = text
    let { mask } = this.props
    if (mask) {
      let masks = mask.match(/((?!\#).)/g)
      if (masks) {
        for (let i = 0; i < masks.length; i++) {
          _text = _text.replace(new RegExp(LibUtils.escapeRegExp(masks[i]), 'g'), '')
        }
      }
      return _text
    }
    return _text
  }

  setText(text: string): void {
    if (this.ref) {
      this.ref.setNativeProps({ text: this.mask(text) })
      this.text = this.mask(text)
      this.clearError()
    }
  }

  componentDidUpdate(prevProps: LibInput_rectangle2Props, prevState: LibInputState): void {
    if (this.ref) {
      this.ref.setNativeProps({ text: this.mask(this.text) })
    }
  }

  componentDidMount(): void {
    super.componentDidMount()
    const timeout = createTimeout()
    timeout.set(() => {
      if (this.props.defaultValue) {
        this.setText(this.props.defaultValue)
      }
      timeout.clear()
    }, 300);
  }

  render(): any {
    const { error } = this.state
    return (
      <>
        <View pointerEvents={this.props.editable == false ? "none" : "auto"} style={[{ height: 32, borderRadius: 1, marginTop: 12, backgroundColor: error ? "#ffefef" : "#ffffff", borderWidth: 1, borderColor: error ? "#e44545" : "#c5c5c5", flexDirection: 'row', alignItems: 'center' }, this.props.style]} >
          {
            this.props.hint &&
            <Text style={{ paddingLeft: 8, fontSize: 10, fontWeight: "normal", fontStyle: "normal", letterSpacing: 0, color: "#4b4b4b" }} >{this.props.hint}</Text>
          }
          <TextInput
            ref={(r) => this.ref = r}
            placeholder={this.props.placeholder}
            placeholderTextColor='#c5c5c5'
            maxLength={this.props.mask ? this.props.mask.length : undefined}
            {...this.props}
            onChangeText={(e) => {
              this.text = this.mask(e)
              if (error != undefined)
                this.clearError()
              if (this.props.onChangeText) this.props.onChangeText(e)
            }}
            style={[{ flex: 1, fontSize: 12, color: error ? "#e44545" : "#000", marginRight: 15, marginLeft: 8 }, this.props.inputStyle]}
          />
          {
            error && this.props.close &&
            <TouchableOpacity onPress={() => {
              if (error != undefined) {
                this.clearError()
                this.setText("")
              }
            }} style={{ margin: 7 }} >
              <LibIcon name="close-circle" size={18} color="#e44545" />
            </TouchableOpacity>
          }
          {
            this.props.dropdown &&
            <TouchableOpacity style={{ margin: 5 }} >
              <LibIcon name="chevron-down" color="#4b4b4b" size={16} />
            </TouchableOpacity>
          }
        </View>
        {
          error &&
          <View style={{ flex: 1, marginHorizontal: 8, marginTop: 4 }} >
            <Text style={{ fontSize: 8, fontWeight: "normal", fontStyle: "normal", letterSpacing: 0, color: "#e44545" }} >{error}</Text>
          </View>
        }
      </>
    )
  }
}