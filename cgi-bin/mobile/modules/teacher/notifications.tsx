// withHooks

import { MaterialIcons } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React, { useState } from 'react';
import { Platform, Pressable, Switch, Text, View } from 'react-native';




export interface TeacherNotificationsArgs {

}
export interface TeacherNotificationsProps {

}
function m(props: TeacherNotificationsProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }

    const [isEnabled, setIsEnabled] = useState(false);
    const toggleswitch = () => setIsEnabled(previousState => !previousState);



    return (
        <View style={{ flex: 1, paddingTop: LibStyle.STATUSBAR_HEIGHT+10, backgroundColor: '#FFFFFF',paddingHorizontal:10 }}>
            <Pressable style={{ marginLeft: 15 }} onPress={() => LibNavigation.back()}>
                <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', flexDirection: 'row' }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                    <Text style={{ fontSize: 20, fontWeight: 'bold', marginLeft: 10, color: 'black' }}>Pengaturan Notifikasi</Text>
                </View>
            </Pressable>


            <View style={{ flexDirection: 'row', marginTop: 20,justifyContent:'center',alignItems:'center'}}>
                <View style={{ width:LibStyle.width*0.7,}}>
                <Text style={{  fontSize: 16 }}>Terima notifikasi dari aplikasi, untuk menerima kehadiran anak didik anda</Text>
                </View>
                <Switch style={{marginRight: 10, marginLeft: 10 }}
                    trackColor={{ false: '#767577', true: '#81B0FF' }}
                    thumbColor={isEnabled ? '#136B93' : '#F3F4F4'}
                    ios_backgroundColor='#3E3E3E'
                    onValueChange={toggleswitch}
                    value={isEnabled}
                />
            </View>



        </View>
    );
}
export default m