// withHooks

import { MaterialIcons } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React from 'react';
import { memo } from 'react';
import { Image, Platform, Pressable, Text, TouchableOpacity, View } from 'react-native';
import { TextInput } from 'react-native-gesture-handler';


export interface TeacherPasswordArgs {
    
}
export interface TeacherPasswordProps {
    
}
function m(props: TeacherPasswordProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24};
        }
        return {elevation: value };
    }
    return (
        <View style={{ flex: 2, backgroundColor: '#FFFFFF', marginTop: LibStyle.STATUSBAR_HEIGHT}}>

            <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 5 }}>
                <TouchableOpacity style={{ position: 'absolute', marginTop: 20, marginLeft: 20 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                </TouchableOpacity>
            </View>

            <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 95 }}>
                <Image source={require('../../assets/otp.png')} style={{ width: 300, height: 190}}/>
            </View>

            <View style={{ alignContent: 'center', justifyContent: 'center', marginTop: 55 }}>
                <Text style={{ color: '#000000', fontSize: 17, fontWeight: 'bold', marginLeft: 19, marginRight: 19, marginBottom: 10 }}>Masukan Email anda untuk mengirim permintaan Password Kepada Admin dan kata sandi akan dikirim melalui email anda.</Text>
                <View style={{ marginTop: 15, backgroundColor: '#FFFFFF', width: LibStyle.width - 40, alignSelf: 'center', borderRadius: 10, marginBottom: 20, ...elevation(3), flexDirection: 'row', alignItems: 'center' }}>
                <TextInput
                    placeholder='Masukkan Email Anda'
                    autoCorrect={true}
                    style={{ marginLeft: 10, width: LibStyle.width - 10, height: 55 }}
                />
                </View>
            </View>

            <View style={{ alignItems: 'center', marginTop: 10 }}>
            <Pressable onPress={()=>{LibNavigation.navigate('teacher/profile')}} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'center', flexDirection: 'row', alignItems: 'center', borderRadius: 15 }}>
                <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18 }}>Kirim</Text>
            </Pressable>
            </View>

        </View>
    )
}
export default memo(m)