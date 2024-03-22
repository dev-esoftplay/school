// withHooks
import { useEffect } from 'react';

import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibList } from 'esoftplay/cache/lib/list/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React from 'react';
import { Pressable, Text, View } from 'react-native';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import useSafeState from 'esoftplay/state';


export interface AttendReport_detailArgs {

}
export interface AttendReport_detailProps {

}
export default function m(props: AttendReport_detailProps): any {
  
    const dates: string = LibNavigation.getArgsAll(props).date;
    const endpoints: string = LibNavigation.getArgsAll(props).endpoints;
    const unfinished_schadule = LibNavigation.getArgsAll(props).unfinishedSchadule;
    const [resApi, setResApi] = useSafeState<any>([])
    useEffect(() => {
        console.log('Attendance Report')
        // http://api.test.school.esoftplay.com/teacher_schedule_report?month=2&week=3
        console.log(endpoints)
        new LibCurl(endpoints , null, (result) => {
          console.log('result', result)
          setResApi(result)
        }, (err) => {
          setResApi(resApi.schedule_days = [])
          console.log('err', err)
        })
      }, [])
   
   
    function shadows(value: number) {
        return {
            elevation: 3, // For Android
            shadowColor: 'black', // For iOS
            shadowOffset: { width: 2, height: 5 },
            shadowOpacity: 0.9,
            shadowRadius: value,
        }
    }

    return (
        <View style={{ flex: 1, marginTop: LibStyle.STATUSBAR_HEIGHT }}>


            <LibList data={resApi} // Use the converted array
                keyExtractor={(item, index) => index.toString()}
                style={{paddingHorizontal:10, }}
                ListHeaderComponent={() => {

                    return (
                        <View style={{ flexDirection: 'row', alignContent: "center" }}>
                            <Pressable onPress={() => LibNavigation.back()} style={{ flexDirection: 'row'}}>
                                <LibIcon name="chevron-left" size={30} color="black" />
                                <Text style={{ fontSize: 20, fontWeight: 'bold' }}>Detail Absensi</Text>
                            </Pressable>
                        </View>
                    )
                }}
                ListFooterComponent={
                    <View>
                        {unfinished_schadule && unfinished_schadule !== 0 ? (
                            <View style={{ justifyContent: 'center', alignItems: 'center', padding: 10, marginVertical: 10 }}>
                                <Text style={{ fontSize: 14, fontWeight: 'bold', color: 'red' }}>Ada {unfinished_schadule} jadwal yang belum terabsen</Text>
                            </View>
                        ) : (
                            <View style={{ justifyContent: 'center', alignItems: 'center', padding: 10, marginVertical: 10 }}>
                                <Text style={{ fontSize: 14, fontWeight: 'bold', color: '#767776' }}>Jadwal telah terabsen semua</Text>
                            </View>
                        )
                        }


                    </View>
                }
                renderItem={(item: any, index: number) => {
                    console.log("item", item);
                    console.log('class id', item?.class?.id)
                    return (
                        <View style={{ backgroundColor: '#008000bd', padding: 5, paddingHorizontal: 20, borderRadius: 14, opacity: 0.8, ...shadows(3), marginVertical: 5 }}>
                            {/* id class dan schadule id */}
                            <Pressable onPress={() => LibNavigation.navigate('teacher/attendeport_student', { idclas: item?.class?.id, date: dates, schedule_id: item.schedule_id })}>
                                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                                    <Text style={{ fontSize: 14, fontWeight: 'bold', color: 'white' }}>{item?.class?.name} </Text>
                                    <View style={{ height: 20, width: 'auto', borderRadius: 8, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>
                                        <Text style={{ fontSize: 14, fontWeight: 'bold', color: item?.student_attend != item.student_number ? 'white' : 'white' }}> {item?.student_attend}/{item?.student_number}</Text>
                                    </View>
                                </View>
                                <View style={{ height: 40,  borderRadius: 8, justifyContent: 'flex-start', alignItems: 'center', flexDirection:'row' }}>
                                   <View style={{ padding:5, justifyContent: 'center', alignItems: 'center', }}>
                                    <Text style={{ fontSize: 14, fontWeight: 'bold', color: 'white' }}>{item?.course?.name}</Text>
                                    </View>
                                </View>
                               
                                <View style={{ flexDirection: 'row', justifyContent: 'flex-end' }}>
                                    <Text style={{ fontSize: 14, fontWeight: 'bold', color: 'white' }}>{item?.clock_start}-{item?.clock_end}</Text>
                                </View>
                            </Pressable>
                        </View>
                    )
                }

                } />



        </View>
    )
}