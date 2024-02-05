import React, { useRef, useState } from 'react';
import { Image, Pressable, StyleSheet, Text, TextInput, View } from 'react-native';
import SchoolColors from '../utils/schoolcolor';
import navigation from 'esoftplay/modules/lib/navigation';
import Lib from '@ant-design/icons';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import esp from 'esoftplay/esp';

export interface AuthOtpArgs {}
export interface AuthOtpProps {}

export default function AuthOtp(props: AuthOtpProps): JSX.Element {
  const  schhol = new SchoolColors();
  const firstInput = useRef<TextInput>(null);
  const secondInput = useRef<TextInput>(null);
  const thirdInput = useRef<TextInput>(null);
  const fourthInput = useRef<TextInput>(null);
  const [otp, setOtp] = useState<{ 1: string; 2: string; 3: string; 4: string }>({
    1: '',
    2: '',
    3: '',
    4: '',
  });
  const otpString = `${otp[1]}${otp[2]}${otp[3]}${otp[4]}`;

  const handleInputChange = (key: keyof typeof otp, text: string) => {
    setOtp((prevOtp) => ({ ...prevOtp, [key]: text }));
    text? focusNextInput(key + 1 as keyof typeof otp) : focusNextInput(key - 1 as keyof typeof otp);
  
  };

  const focusNextInput = (key: keyof typeof otp) => {
    switch (key) {
      case 1:
        firstInput.current?.focus();
        break;
      case 2:
        secondInput.current?.focus();
        break;
      case 3:
        thirdInput.current?.focus();
        break;
      case 4:
        fourthInput.current?.focus();
        break;
      default:
        break;
    }
  };

  return (
    <View style={styles.container}>
      <LibPicture source={esp.assets('otp.png')} style={styles.image} />
      <Text style={styles.text}>
        Masukkan OTP yang dikirim ke email Anda untuk memperbarui kata sandi Anda
      </Text>
      <View style={styles.inputContainer}>
        {[1, 2, 3, 4].map((key) => (
          <TextInput
            key={key}
            style={styles.input}
         
            onChangeText={(text) => handleInputChange(key as keyof typeof otp, text)}
            
            keyboardType="numeric"
            maxLength={1}
            ref={
              key === 1
                ? firstInput
                : key === 2
                ? secondInput
                : key === 3
                ? thirdInput
                : fourthInput
            }
          />
        ))}
      </View>
      <Pressable onPress={() => {navigation.navigate('auth/resetpass')}} style={{ width: 328,height:58,borderRadius:7,backgroundColor:schhol.primary,marginTop:30}}>
        <Text style={{color:'white',textAlign:'center',paddingTop:17,fontSize:16}}>Lanjutkan</Text>
      </Pressable>

     
      <Text style={styles.text}>Tidak menerima kode? Kirim ulang</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  image: {
    marginTop: 75,
  },
  text: {
    marginTop: 30,
    textAlign: 'center',
    justifyContent: 'center',
  },
  inputContainer: {
    flexDirection: 'row',
    marginTop: 20,
  },
  input: {
    alignContent:'center',
    alignItems:'center',
    justifyContent:'center',
    width: 60,
    height: 50,
    borderWidth: 1,
    borderColor: 'gray',
    borderRadius: 5,
    textAlign: 'center',
    marginRight: 10,
  },
});