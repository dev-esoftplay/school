// withHooks
import React, { useEffect, useRef, useState } from 'react';

import { memo } from 'react';

// import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { MaterialIcons, FontAwesome5 } from '@expo/vector-icons';
// import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Image, Platform, View, Text, TouchableOpacity, Pressable } from 'react-native';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
// import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
// import navigation from 'esoftplay/modules/lib/navigation';
// import { Auth } from '../auth/login';


export interface ParentInfoArgs {

}
export interface ParentInfoProps {

}

// let slideup = useRef<LibSlidingup>(null)


function m(props: ParentInfoProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowEffect: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }

    const [ParentStudent, setParentStudent] = useState<any>([])

    const hitApi = () => { }

    function loadParentStudent() {
        new LibCurl('parent_student', get, (result, msg) => {
            console.log(ParentStudent)
            setParentStudent(result)
        }, (err) => {
            console.log("error", err)
        }, 1)
    }

    useEffect(() => {
        loadParentStudent();
    }, [])

    return (
        <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 70, ...elevation(6) }}>

            <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 5 }}>
                <TouchableOpacity onPress={() => LibNavigation.back()} style={{ position: 'absolute', marginTop: -40, marginLeft: -185 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color={'#000000'} />
                </TouchableOpacity>
            </View>

            <View style={{ justifyContent: 'center', marginTop: 10, marginBottom: 10 }}>
                <Image source={{ uri: 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }} style={{ width: 165, height: 165, borderRadius: 165 / 2, borderWidth: 3, borderColor: '#FAFAFA', ...elevation(5) }}></Image>
                {/* <Text style={{ color: '#000000', fontWeight: 'bold', fontSize: 25, textAlign: 'center', padding: 10 }}>Rocket Racoon, S.Ag, S.E, M.Pd, S.Pd</Text> */}
                <Pressable style={{position: 'absolute', bottom: 0, right: 5, borderRadius: 45 / 2, backgroundColor: '#4B7AD6', width: 45, height: 45, justifyContent: 'center', alignItems: 'center', elevation: 3, shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                    <MaterialIcons name='edit' size={20} color='#FFFFFF' />
                </Pressable>
            </View>

            {/* <View style={{ justifyContent: 'center', flexDirection: 'row', marginTop: 10, marginHorizontal: 20, }}>
                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#4B7AD6', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Edit Profile?</Text>
                </TouchableOpacity>

                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#4B7AD6', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Edit Photo Profile?</Text>
                </TouchableOpacity>
            </View> */}

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginRight: 320, alignContent: 'center', textAlign: 'left' }}>Nama</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'space-between', padding: 16, paddingHorizontal: 10, borderRadius: 8, flexDirection: 'row', elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'center', textAlign: 'left', color: '#898989' }}>{ParentStudent.name}</Text>
                <MaterialIcons name="edit" size={20} color="#4B7AD6" style={{}} />
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 280, alignContent: 'flex-start', textAlign: 'left' }}>Nomor Telp</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'space-between', padding: 18, paddingHorizontal: 10, borderRadius: 8, flexDirection: 'row', elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'center', textAlign: 'left', color: '#898989' }}>+{ParentStudent.phone}</Text>
                <MaterialIcons name="edit" size={20} color="#4B7AD6" />
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 270, alignContent: 'flex-start', textAlign: 'left' }}>Tanggal Lahir</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'space-between', padding: 18, paddingHorizontal: 10, borderRadius: 8, flexDirection: 'row', elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'center', textAlign: 'left', color: '#898989' }}>{ParentStudent?.student_data?.[0]?.birthday}</Text>
                <MaterialIcons name="edit" size={20} color="#4B7AD6" />
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 320, alignContent: 'center', textAlign: 'left' }}>Alamat</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'space-between', padding: 18, paddingHorizontal: 10, borderRadius: 8, flexDirection: 'row', elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>{ParentStudent.student_data?.[0].class_name}</Text>
                <MaterialIcons name="edit" size={20} color="#4B7AD6" />
            </View>

            <Pressable onPress={() => LibNavigation.back()} style={{ padding: 13, alignItems: 'center', alignContent: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, height: 55, marginTop: 30, width: 370 }}>
                <Text style={{ justifyContent: 'center', fontSize: 17, color: '#FFFFFF' }}>Simpan</Text>
            </Pressable>
        </View>
    )
}
export default memo(m);