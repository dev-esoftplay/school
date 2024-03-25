// withHooks
import { memo } from 'react';

import { MaterialIcons } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import React, { useState } from 'react';
import { View, Switch, Text, Platform } from 'react-native';
import { TouchableOpacity } from 'react-native-gesture-handler';


export interface ParentNotifArgs {

}
export interface ParentNotifProps {

}
function m(props: ParentNotifProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowEffect: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }

    const [isEnabled, setIsEnabled] = useState(false);
    const toggleswitch = () => setIsEnabled(previousState => !previousState);


    return (
        <View style={{ flex: 0.3, marginTop: 30, justifyContent: 'center', backgroundColor: '#FFFFFF' }}>
            <Text style={{ marginLeft: 10, marginRight: 75, fontSize: 16 }}>Terima notifikasi dari nama aplikasi, untuk menerima kehadiran anak didik Anda</Text>

            <View style={{ marginTop: -150 }}>
                <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 20 }}>
                    <TouchableOpacity onPress={()=> LibNavigation.back()}style={{ marginLeft: 15 }}>
                        <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                    </TouchableOpacity>
                </View>
            </View>

            <Switch style={{ marginTop: 50, marginRight: 10, marginLeft: 10 }}
                trackColor={{ false: '#767577', true: '#81B0FF' }}
                thumbColor={isEnabled ? '#136B93' : '#F3F4F4'}
                ios_backgroundColor='#3E3E3E'
                onValueChange={toggleswitch}
                value={isEnabled}
            />

        </View>
    );
}
export default memo(m);